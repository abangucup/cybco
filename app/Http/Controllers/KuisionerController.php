<?php

namespace App\Http\Controllers;

use App\Models\Kuisioner;
use App\Models\Pertanyaan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KuisionerController extends Controller
{
    public function index()
    {
        $jumlahKuis = Kuisioner::count();
        $siswas = Siswa::has('kuisioner')->with('kuisioner')->paginate(5);
        return view('kelola.kuisioner.index', compact('siswas', 'jumlahKuis'));
    }

    // INI ROLE SISWA
    public function create()
    {
        $pertanyaans = Pertanyaan::all();
        $siswa = Siswa::where('id', auth()->user()->biodata->siswa->id)->first();
        return view('siswa.kuisioner.index', compact('pertanyaans', 'siswa'));
    }

    public function store(Request $request)
    {
        $siswaId = $request->input('siswa');
        $pertanyaans = $request->input('pertanyaan');
        $jawaban = $request->input('jawaban');

        foreach ($pertanyaans as $key => $pertanyaanId) {
            $kuisioner = new Kuisioner();
            $kuisioner->pertanyaan_id = $pertanyaanId;
            $kuisioner->siswa_id = $siswaId;
            $kuisioner->jawaban = $jawaban[$key];
            $kuisioner->save();
        }

        Alert::success('Berhasil Simpan', 'Kuisioner berhasil disimpan');
        return redirect()->back();
    }
}
