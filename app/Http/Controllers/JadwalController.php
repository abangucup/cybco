<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Pertanyaan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class JadwalController extends Controller
{
    // UNTUK ROLE SISWA
    public function jadwalSiswa()
    {
        if (auth()->user()->biodata->siswa->kuisioner->isEmpty()) {
            return redirect()->route('kuisioner.create');
        }
        $siswa = Auth::user()->biodata->siswa;
        return view('siswa.jadwal.index', compact('siswa'));
    }

    // ROLE GURU
    public function index()
    {
        $siswas = Siswa::has('kuisioner')->get()
            ->filter(function ($siswa) {
                $jumlahKuis = Pertanyaan::count();
                $persen = ($siswa->kuisioner()->where('jawaban', 'ya')->count() / $jumlahKuis) * 100;
                return $persen > 50;
            });
        $jadwals = Jadwal::where('guru_id', auth()->user()->biodata->guru->id)->paginate(5);
        return view('guru.jadwal.index', compact('jadwals', 'siswas'));
    }

    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'siswa_id' => 'required',
            'tanggal_konseling' => 'required',
            'jam_konseling' => 'required',
            'keterangan' => 'required',
        ]);

        if ($validasi->fails()) {
            Alert::error('Gagal tambah', 'Jadwal gagal ditambahkan');
            return redirect()->back();
        }

        $jadwal = new Jadwal();
        $jadwal->guru_id = Auth::user()->biodata->guru->id;
        $jadwal->siswa_id = $request->siswa_id;
        $jadwal->tanggal_konseling = $request->tanggal_konseling;
        $jadwal->jam_konseling = $request->jam_konseling;
        $jadwal->keterangan = $request->keterangan;
        $jadwal->save();

        Alert::success('Tambah Jadwal', 'Jadwal berhasil ditambahkan');
        return back();
    }

    public function update(Request $request, $id)
    {
        $validasi = Validator::make($request->all(), [
            'siswa_id' => 'required',
            'tanggal_konseling' => 'required',
            'jam_konseling' => 'required',
            'keterangan' => 'required',
        ]);

        if ($validasi->fails()) {
            Alert::error('Gagal tambah', 'Jadwal gagal ditambahkan');
            return redirect()->back();
        }

        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update([
            'siswa_id' => $request->siswa_id,
            'tanggal_konseling' => $request->tanggal_konseling,
            'jam_konseling' => $request->jam_konseling,
            'keterangan' => $request->keterangan,
        ]);

        Alert::success('Ubah Jadwal', 'Berhasil ubah jadwal konseling');
        return back();
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        Alert::success('Hapus Jadwal', 'Jadwal berhasil dihapus');
        return back();
    }
}
