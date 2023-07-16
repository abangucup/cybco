<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        $jumlahSiswa = Siswa::count();
        $jumlahGuru = Guru::count();
        return view('admin.dashboard', compact([
            'jumlahSiswa',
            'jumlahGuru',
        ]));
    }

    public function guru()
    {
        return view('guru.dashboard');
    }

    public function siswa()
    {
        return view('siswa.dashboard');
    }
}
