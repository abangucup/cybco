<?php

namespace App\Http\Controllers;

use App\Models\Riwayat;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    // UNTUK ROLE SISWA
    public function riwayatSiswa()
    {
        return 'RIWAYAT';
    }

    // ROLE GURU
    public function index()
    {
        $riwayats = Riwayat::paginate(5);
        return view('guru.riwayat.index', compact('riwayats'));
    }
}
