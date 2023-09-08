<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::paginate(10);
        return view('admin.guru.index', compact('guru'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'nuptk' => 'required|unique:gurus',
            'telepon' => 'required',
        ]);

        $biodata = new Biodata();
        $biodata->nama = $request->nama;
        $biodata->telepon = '62' . $request->telepon;
        $biodata->alamat = $request->alamat;
        if ($request->file('foto')) {
            $foto = $request->file('foto');
            $fotoName = time() . '.' . $foto->getClientOriginalExtension();

            $path = $foto->storeAs('public/gambar', $fotoName);
            $url = Storage::url($path);
            $biodata->foto = $url;
        }
        $biodata->save();

        $guru = new Guru();
        $guru->biodata_id = $biodata->id;
        $guru->nuptk = $request->nuptk;
        $guru->save();

        $user = new User();
        $user->username = $guru->nuptk;
        $user->password = Hash::make($guru->nuptk);
        $user->biodata_id = $biodata->id;
        $user->role = 'guru';
        $user->save();

        Alert::success('Simpan Data Guru', 'Data guru berhasil ditambahkan');
        return back();
    }

    public function update(Request $request, $id)
    {
        $validasi = Validator::make($request->all(), [
            'nama' => 'required',
            'nuptk' => 'required|unique:gurus',
            'telepon' => 'required',
        ]);

        $cekNuptk = Guru::where('nuptk', $request->nuptk)->where('id', '!=', $id)->first();
        if ($cekNuptk) {
            if ($validasi->fails()) {
                Alert::error('Error', 'Data gagal tersimpan');
                return back();
            }
        }

        $guru = Guru::findOrFail($id);

        $guru->biodata->update([
            'nama' => $request->nama,
            'telepon' => '62' . $request->telepon,
            'alamat' => $request->alamat,
        ]);
        if ($request->file('foto')) {
            // Hapus foto lama
            Storage::disk('public')->delete(Str::after($guru->biodata->foto, 'storage/'));

            // Upload foto baru
            $foto = $request->file('foto');
            $fotoName = time() . '.' . $foto->getClientOriginalExtension();
            $path = $foto->storeAs('public/gambar', $fotoName);
            $url = Storage::url($path);
            $guru->biodata->update([
                'foto' => $url,
            ]);
        }

        $guru->update([
            'nuptk' => $request->nuptk,
        ]);

        $guru->biodata->user->update([
            'username' => $guru->nuptk,
            'password' => Hash::make($guru->nuptk),
        ]);

        Alert::success('Edit Data Guru', 'Data guru berhasil diubah');
        return back();
    }


    public function destroy(Guru $guru)
    {
        $guru->biodata->delete();
        Storage::disk('public')->delete(Str::after($guru->biodata->foto, 'storage/'));

        Alert::success('Hapus Data Guru', 'Guru ' . $guru->biodata->nama . ' berhasil dihapus');
        return back();
    }
}
