<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function updateOrtu(Request $request)
    {
        $validasi = Validator::make($request->all(), [
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

    public function show($id)
    {
        // cek apakah user guru, admin, atau siswa
        $user = User::findOrFail($id);
        if ($user->role == 'admin') {
            $profile = User::where('id', $id)->with('biodata')->first();
        } elseif ($user->role == 'guru') {
            $profile = User::where('id', $id)->with('biodata', 'biodata.guru')->first();
        } else {
            $profile = User::where('id', $id)->with('biodata', 'biodata.siswa')->first();
        }

        return view('templates.profile.show_profile', compact('profile'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validasi = Validator::make($request->all(), [
            'nama' => 'required',
            'telepon' => 'required',
        ]);

        if ($validasi->fails()) {
            Alert::error('Error', 'Data gagal tersimpan');
            return back();
        }
        $biodata = Biodata::findOrFail($id);

        $biodata->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => '62' . $request->telepon,
        ]);

        if ($request->file('foto')) {
            // Hapus foto lama
            Storage::disk('public')->delete(Str::after($biodata->foto, 'storage/'));

            // Upload foto baru
            $foto = $request->file('foto');
            $fotoName = time() . '.' . $foto->getClientOriginalExtension();
            $path = $foto->storeAs('public/gambar', $fotoName);
            $url = Storage::url($path);
            $biodata->update([
                'foto' => $url,
            ]);
        }

        Alert::success('Ubah Profile', 'Profile Berhasil Di Ubah');
        return back();
    }
}
