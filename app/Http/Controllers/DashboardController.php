<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $jumlahSiswa = Siswa::count();
        $jumlahGuru = Guru::count();

        return view('guru.dashboard', compact([
            'jumlahSiswa',
            'jumlahGuru',
        ]));
    }

    public function siswa()
    {
        $cekKuisioner = Siswa::where('nis', auth()->user()->biodata->siswa->nis)->first();
        if (auth()->user()->biodata->siswa->kuisioner->isEmpty()) {
            return redirect()->route('kuisioner.create');
        }

        $siswa = Auth::user()->biodata->siswa;
        $jumlahJadwal = Jadwal::where('siswa_id', $siswa->id)->count();
        $jumlahGuru = Guru::count();
        return view('siswa.dashboard', compact('jumlahJadwal', 'jumlahGuru'));
    }
}
