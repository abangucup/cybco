<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function updateOrtu(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nama_ortu' => 'required',
            'telepon_ortu' => 'required',
        ]);

        if ($validasi->fails()) {
            Alert::error('Gagal Simpan', 'Data orang tua gagal tersimpan');
            return redirect()->back();
        }

        $siswa = Siswa::where('id', auth()->user()->biodata->siswa->id)->first();
        $siswa->update([
            'nama_ortu' => $request->nama_ortu,
            'telepon_ortu' => $request->telepon_ortu,
        ]);

        Alert::success('Berhasil Simpan', 'Data orang tua berhasil disimpan');
        return redirect()->back();
    }
}
