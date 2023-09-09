<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;

class LaporanController extends Controller
{
    public function laporan()
    {
        // $siswas = Siswa::all();
        // $siswa = Siswa::where('id', auth()->user()->biodata->siswa->id)->first();
        // $siswas = Siswa::all();
        // $riwayats = $siswa->riwayat()->paginate(5);
        // $siswas = Siswa::all();
        $jadwals = Jadwal::all();

        return view('report.index', compact('jadwals'));
    }

    public function unduhDataById($id)
    {
        // $data = DD::table('nama_tabel')->find($id); // Ganti 'nama_tabel' dengan nama tabel Anda
        $jadwal = Jadwal::findOrFail($id);

        if ($jadwal) {
            $filename = 'jadwal_' . $jadwal->siswa->biodata->nama . '.txt';
            $fileContents = json_encode($jadwal, JSON_PRETTY_PRINT);

            return Response::make($fileContents, 200, [
                'Content-Type' => 'application/json',
                'Content-Disposition' => 'attachment; filename=' . $filename,
            ]);
        } else {
            return abort(404, 'Data not found');
        }
    }

    public function unduhSemuaData()
    {
        // $data = DB::table('nama_tabel')->get(); // Ganti 'nama_tabel' dengan nama tabel Anda
        $jadwal = Jadwal::all();

        if ($jadwal->isEmpty()) {
            return abort(404, 'No data found');
        }

        $filename = 'semua_data.txt';
        $fileContents = json_encode($jadwal, JSON_PRETTY_PRINT);

        return Response::make($fileContents, 200, [
            'Content-Type' => 'application/json',
            'Content-Disposition' => 'attachment; filename=' . $filename,
        ]);
    }
}
