<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function laporan()
    {
        $jadwals = Jadwal::all();

        return view('report.index', compact('jadwals'));
    }

    public function unduhDataById($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $pdf = Pdf::loadView('report.print.report_by_id', compact('jadwal'));
        return $pdf->download($jadwal->siswa->biodata->nama . '.pdf');
    }

    public function unduhSemuaData()
    {
        $jadwals = Jadwal::all();
        $pdf = Pdf::loadView('report.print.report_all', compact('jadwals'));
        return $pdf->download('riwayat.pdf');
    }
}
