<?php

namespace App\Http\Controllers;

use App\Models\Society;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use File;

class SocietyController extends Controller
{
    public function index()
    {
        $data['society'] = Society::all();
        return view('admin.society.index', $data);
    }

    public function create()
    {
        return view('admin.society.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nik' => 'required|min:2|max:20',
            'username' => 'required|min:2|max:20',
            'email' => 'required|min:2',
            'name' => 'required|min:2|max:20',
            'password' => 'required|min:5|max:20',
            'phone_number' => 'required',
            'address' => 'required',
            'photo' => 'required',
        ]);
        $society = new Society;
        $society->nik = $request->nik;
        $society->username = $request->username;
        $society->email = $request->email;
        $society->name = $request->name;
        $society->phone_number = $request->phone_number;
        $society->address = $request->address;
        $society->password = Hash::make($request->password);
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('avatar_society', 'public');
            $society->photo = basename($path);
        }
        $society->save();
        if ($request->submit == "more") {
            return redirect()->route('society.create')->with(['success' => 'Berhasil Disimpan !']);
        } else {
            return redirect()->route('society.index')->with(['success' => 'Berhasil Disimpan']);
        };
    }
    public function destroy($id)
    {
        $society = Society::findOrFail($id);
        $society->delete();
        return redirect()->back()->with(['success' => 'Berhasil Dihapus']);
    }

    public function edit($id)
    {
        $data['society'] = Society::findOrFail($id);
        return view('admin.society.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nik' => 'required|min:2|max:20',
            'username' => 'required|min:2',
            'email' => 'required|min:2|max:20',
            'name' => 'required|min:2|max:20',
            'phone_number' => 'required',
            'address' => 'required',
        ]);
        $society = Society::findOrFail($id);
        $society->nik = $request->nik;
        $society->username = $request->username;
        $society->email = $request->email;
        $society->name = $request->name;
        $society->phone_number = $request->phone_number;
        $society->address = $request->address;
        if ($request->get('password') != '') {
            $society->password = Hash::make($request->password);
        }
        if ($request->hasFile('photo')) {
            if ($request->photo && Storage::disk('public')->exists('avatar/' . $request->photo)) {
                Storage::disk('public')->delete('avatar_society/' . $request->photo);
            }
            $path = $request->file('photo')->store('avatar_society', 'public');
            $request->photo = basename($path);
        }
        $result = $society->save();
        if ($result) {
            return redirect()->route('society.index')->with(['success' => 'Berhasil Diperbarui']);
        } else {
            return redirect()->back();
        }
    }
}
