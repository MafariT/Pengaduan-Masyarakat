<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Response;
use App\Models\Society;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Date;

class FrontendController extends Controller
{
    public function register()
    {
        return view('frontend.register.index');
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'nik' => 'required|digits:16|numeric|unique:society,nik',
            'name' => 'required|min:2|max:50',
            'username' => 'required|min:4|max:30|unique:society,username',
            'email' => 'required|email|unique:society,email',
            'phone_number' => 'required|min:10|max:15',
            'address' => 'required|min:5|max:255',
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'required',
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus terdiri dari 16 angka.',
            'nik.numeric' => 'NIK hanya boleh berisi angka.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'name.required' => 'Nama wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar, silakan gunakan email lain.',
            'phone_number.required' => 'Nomor telepon wajib diisi.',
            'address.required' => 'Alamat wajib diisi.',
            'photo.required' => 'Foto wajib diunggah.',
            'photo.image' => 'File foto harus berupa gambar (jpg, jpeg, atau png).',
            'photo.mimes' => 'Format foto harus jpg, jpeg, atau png.',
            'photo.max' => 'Ukuran foto maksimal 2MB.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $society = new Society;
        $society->nik = $request->nik;
        $society->name = $request->name;
        $society->username = $request->username;
        $society->email = $request->email;
        $society->phone_number = $request->phone_number;
        $society->address = $request->address;
        $society->password = Hash::make($request->password);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('avatar_society', 'public');
            $society->photo = basename($path);
        }

        $result = $society->save();

        if ($result) {
            return redirect()->route('user_login')->with(['success' => 'Registrasi berhasil! Silakan login.']);
        } else {
            return redirect()->back()->with(['error' => 'Data gagal disimpan.']);
        };
    }

    public function login()
    {
        return view('frontend.login.login');
    }

    public function postlogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $username = $request->username;
        $pw = $request->password;
        $society = Society::where('username', $username)->first();

        if ($society != NULL) {
            if (Hash::check($pw, $society->password)) {
                Session::put('society_id', $society->id);
                Session::put('nik', $society->nik);
                Session::put('name', $society->name);
                Session::put('username', $society->username);
                Session::put('email', $society->email);
                Session::put('photo', $society->photo);
                Session::put('phone_number', $society->phone_number);
                Session::put('address', $society->address);
                return redirect()->route('user_home');
            } else {
                return redirect()->back()->with(['error' => 'Password salah!']);
            }
        } else {
            return redirect()->back()->with(['error' => 'Username tidak ditemukan!']);
        }
    }

    public function home()
    {
        if (Session::get('nik') != NULL) {
            $nik = Session::get('nik');
            $data['count_complaint'] = Complaint::where('nik', $nik)->count();
            return view('frontend.complaint.index', $data);
        } else {
            return redirect('/');
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('/');
    }

    public function add_complaint()
    {
        if (Session::get('nik') != NULL) {
            return view('frontend.complaint.add');
        } else {
            return redirect('/');
        }
    }

    public function save_complaint(Request $request)
    {
        $this->validate($request, [
            'contents_of_the_report' => 'required|min:2',
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'contents_of_the_report.required' => 'Isi laporan wajib diisi.',
            'photo.required' => 'Foto bukti wajib diunggah.',
            'photo.image' => 'File harus berupa gambar.',
            'photo.mimes' => 'Format foto harus jpg, jpeg, atau png.',
            'photo.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        $nik = Session::get('nik');
        $society = Session::get('society_id');
        $complaint = new Complaint;

        $complaint->contents_of_the_report = $request->contents_of_the_report;
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('avatar_complaint', 'public');
            $complaint->photo = basename($path);
        }
        $complaint->status = '0';
        $complaint->date_complaint = Date::now()->format('Y-m-d');
        $complaint->nik = $nik;
        $complaint->society_id = $society;
        $complaint->save();

        $response = new Response;
        $response->complaint_id = $complaint->id;
        $response->save();

        return redirect()->back()->with(['success' => 'Laporan berhasil dikirim!']);
    }

    public function complaint()
    {
        if (Session::get('nik') != NULL) {
            $nik = Session::get('nik');
            $data['complaint'] = Complaint::where('nik', $nik)->get();
            return view('frontend.complaint.index1', $data);
        } else {
            return redirect('/');
        }
    }

    public function detail_complaint($id)
    {
        if (Session::get('nik') != NULL) {
            $data['complaint'] = Complaint::findOrFail($id);
            return view('frontend.complaint.detail', $data);
        } else {
            return redirect('/');
        }
    }

    public function search_complaint(Request $request)
    {
        $this->validate($request, [
            'nik' => 'required|digits:16|numeric',
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus 16 angka.',
            'nik.numeric' => 'NIK hanya boleh berisi angka.',
        ]);

        $nik = $request->nik;
        $data['complaints'] = Complaint::with('society')->where('nik', $nik)->get();
        $data['search_nik'] = $nik;

        return view('frontend.search_result', $data);
    }

    public function track_complaint()
    {
        return view('frontend.track_complaint');
    }
}
