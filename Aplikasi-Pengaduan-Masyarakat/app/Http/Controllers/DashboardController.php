<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Society;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        
        $data['complaints'] = Complaint::count();
        $data['users']      = User::count();
        $data['society']    = Society::count();
        $data['unprocessed'] = Complaint::where('status', '0')->count();          
        $data['forwarded']   = Complaint::where('status', 'kelurahan')->count();  
        $data['repair']      = Complaint::where('status', 'perbaikan')->count();  
        $data['finished']    = Complaint::where('status', 'finished')->count();   
        $data['rejected']    = Complaint::where('status', 'rejected')->count();   

        $data['tahun'] = DB::table('complaint')
            ->selectRaw('YEAR(date_complaint) as Tahun, COUNT(id) as pay_total')
            ->groupByRaw('YEAR(date_complaint)')
            ->get();

        return view('admin.dashboards.index', $data);
    }

    public function welcome()
    {
        return view('frontend.home.index');
    }
}
