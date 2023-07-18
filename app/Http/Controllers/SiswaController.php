<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::paginate(10);
        return view('admin.siswa.index', compact('siswa'));
    }

    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nama' => 'required',
            'nis' => 'required|unique:siswas',
            'telepon' => 'required',
            'kelas' => 'required',
        ]);

        if ($validasi->fails()) {
            Alert::error('Error', 'Data gagal tersimpan');
            return back();
        }

        $biodata = new Biodata();
        $biodata->nama = $request->nama;
        $biodata->alamat = $request->alamat;
        $biodata->telepon = $request->telepon;

        if ($request->file('foto')) {
            $foto = $request->file('foto');
            $fotoName = time() . '.' . $foto->getClientOriginalExtension();

            $path = $foto->storeAs('public/gambar', $fotoName);
            $url = Storage::url($path);
            $biodata->foto = $url;
        }
        $biodata->save();

        $siswa = new Siswa();
        $siswa->biodata_id = $biodata->id;
        $siswa->nis = $request->nis;
        $siswa->kelas = $request->kelas;
        $siswa->nama_ortu = $request->nama_ortu;
        $siswa->telepon_ortu = $request->telepon_ortu;
        $siswa->save();

        $user = new User();
        $user->username = $siswa->nis;
        $user->password = Hash::make($siswa->nis);
        $user->biodata_id = $biodata->id;
        $user->role = 'siswa';
        $user->save();

        Alert::success('Tambah Data Siswa', 'Data siswa berhasil ditambahkan');
        return back();
    }

    public function update(Request $request, $id)
    {
        $validasi = Validator::make($request->all(), [
            'nama' => 'required',
            'nis' => 'required|unique:siswas',
            'telepon' => 'required',
            'kelas' => 'required',
        ]);

        $cekNis = Siswa::where('nis', $request->nis)->where('id', '!=', $id)->first();
        if ($cekNis) {
            if ($validasi->fails()) {
                Alert::error('Error', 'Data gagal tersimpan');
                return back();
            }
        }

        $siswa = Siswa::findOrFail($id);

        $siswa->biodata->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
        ]);
        if ($request->file('foto')) {
            // Hapus foto lama
            Storage::disk('public')->delete(Str::after($siswa->biodata->foto, 'storage/'));

            // Upload foto baru
            $foto = $request->file('foto');
            $fotoName = time() . '.' . $foto->getClientOriginalExtension();
            $path = $foto->storeAs('public/gambar', $fotoName);
            $url = Storage::url($path);
            $siswa->biodata->update([
                'foto' => $url,
            ]);
        }

        $siswa->update([
            'nis' => $request->nis,
            'kelas' => $request->kelas,
            'nama_ortu' => $request->nama_ortu,
            'telepon_ortu' => $request->telepon_ortu,
        ]);

        $siswa->biodata->user->update([
            'username' => $siswa->nis,
            'password' => Hash::make($siswa->nis),
        ]);

        Alert::success('Ubah Data Siswa', 'Data siswa berhasil diubah');
        return back();
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->biodata->delete();
        Storage::disk('public')->delete(Str::after($siswa->biodata->foto, 'storage/'));

        Alert::success('Hapus Data Siswa', 'Data siswa berhasil dihapus');
        return back();
    }
}
