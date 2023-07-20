<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    // UNTUK ROLE SISWA
    public function jadwalSiswa()
    {
        if (auth()->user()->biodata->siswa->kuisioner->isEmpty()) {
            return redirect()->route('kuisioner.create');
        }

        return view('siswa.jadwal.index');
    }

    // ROLE GURU
    public function index()
    {
        $jadwals = Jadwal::paginate(5);
        return view('guru.jadwal.index', compact('jadwals'));
    }
}
