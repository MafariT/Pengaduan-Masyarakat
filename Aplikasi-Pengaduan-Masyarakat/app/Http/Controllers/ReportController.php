<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

class ReportController extends Controller
{
    
    public function day(Request $request)
    {
        $date1 = $request->input('date1') ?: now()->toDateString();
        $date2 = $request->input('date2') ?: now()->toDateString();

        [$start, $end] = $this->normalizeRange($date1, $date2);

        $data = DB::table('complaint')
            ->select('id','nik','contents_of_the_report','date_complaint','status')
            ->whereBetween('date_complaint', [$start, $end])
            ->orderBy('id', 'asc')
            ->get();

        return view('admin.report.day.index', compact('data','date1','date2'));
    }

    public function day_search(Request $request)
    {
        $request->validate([
            'date1' => ['required','date'],
            'date2' => ['required','date','after_or_equal:date1'],
        ]);

        [$start, $end] = $this->normalizeRange($request->date1, $request->date2);

        $data = DB::table('complaint')
            ->select('id','nik','contents_of_the_report','date_complaint','status')
            ->whereBetween('date_complaint', [$start, $end])
            ->orderBy('id', 'asc')
            ->get();

        return view('admin.report.day.index', [
            'data'  => $data,
            'date1' => $request->date1,
            'date2' => $request->date2,
        ]);
    }

    public function day_pdf(Request $request)
    {
        $date1 = $request->query('date1') ?: now()->toDateString();
        $date2 = $request->query('date2') ?: now()->toDateString();

        [$start, $end] = $this->normalizeRange($date1, $date2);

        $data = DB::table('complaint')
            ->select('id','nik','contents_of_the_report','date_complaint','status')
            ->whereBetween('date_complaint', [$start, $end])
            ->orderBy('id', 'asc')
            ->get();

        $pdf = PDF::loadView('admin.report.day.print_data', compact('data','date1','date2'))
                  ->setPaper('A4','portrait');

        return $pdf->stream('Laporan-Harian.pdf');
    }

    private function normalizeRange(string $date1, string $date2): array
    {
        $start = Carbon::parse($date1)->startOfDay();
        $end   = Carbon::parse($date2)->endOfDay();
        return [$start, $end];
    }
}
