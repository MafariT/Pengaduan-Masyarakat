<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
    public function index()
    {
        $data['complaints'] = Complaint::all();
        return view('admin.complaints.index', $data);
    }
    public function show($id)
    {
        $data['complaint'] = Complaint::findOrFail($id);
        $data['response'] = Response::where('complaint_id', $id)->first();
        return view('admin.complaints.show', $data);
    }

    public function destroy($id)
    {
        $complaint = Complaint::findOrFail($id);
        $response = Response::where('complaint_id', $id)->first();
        if ($response) {
            $response->delete();
        }

        if ($complaint->photo && Storage::disk('public')->exists('avatar_complaint/' . $complaint->photo)) {
            Storage::disk('public')->delete('avatar_complaint/' . $complaint->photo);
        }
        $complaint->delete();
        return redirect()->route('complaints.index')->with(['success' => 'Data dan file berhasil dihapus']);
    }
}
