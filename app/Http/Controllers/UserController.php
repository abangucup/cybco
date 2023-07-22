<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        $user = User::paginate(10);
        return view('admin.user.index', compact('user'));
    }

    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nama' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'telepon' => 'required',
            'role' => 'required'
        ]);

        if ($validasi->fails()) {
            Alert::error('Gagal Tambah Data', 'Data user gagal ditambahkan');
            return redirect()->back();
        }

        $biodata = new Biodata();
        $biodata->nama = $request->nama;
        $biodata->alamat = $request->alamat;
        $biodata->telepon = '62' . $request->telepon;
        if ($request->file('foto')) {
            $foto = $request->file('foto');
            $fotoName = time() . '.' . $foto->getClientOriginalExtension();

            $path = $foto->storeAs('public/gambar', $fotoName);
            $url = Storage::url($path);
            $biodata->foto = $url;
        }
        $biodata->save();

        if ($request->role == 'siswa') {
            $siswa = new Siswa();
            $siswa->nis = $request->username;
            $siswa->biodata_id = $biodata->id;
            $siswa->kelas = 'Kosong';
            $siswa->save();
        }
        if ($request->role == 'guru') {
            $guru = new Guru();
            $guru->nuptk = $request->username;
            $guru->biodata_id = $biodata->id;
            $guru->save();
        }

        $user = new User();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->biodata_id = $biodata->id;
        $user->role = $request->role;
        $user->save();

        Alert::success('Tambah Data User', 'Data user berhasil ditambahkan');
        return back();
    }

    public function update(Request $request, $id)
    {
        $validasi = Validator::make($request->all(), [
            'nama' => 'required',
            'username' => 'required|unique:users',
            'telepon' => 'required',
            'role' => 'required'
        ]);

        $cekUsername = User::where('username', $request->username)->where('id', '!=', $id)->first();
        if ($cekUsername) {
            if ($validasi->fails()) {
                Alert::error('Gagal Tambah Data', 'Data user gagal ditambahkan');
                return redirect()->back();
            }
        }

        $user = User::findOrFail($id);
        $user->biodata->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => '62' . $request->telepon,
        ]);
        if ($request->file('foto')) {
            // Hapus Foto Sebelumnya
            Storage::disk('public')->delete(Str::after($user->biodata->foto, 'storage/'));

            $foto = $request->file('foto');
            $fotoName = time() . '.' . $foto->getClientOriginalExtension();

            $path = $foto->storeAs('public/gambar', $fotoName);
            $url = Storage::url($path);
            $user->biodata->update([
                'foto' => $url,
            ]);
        }

        // LOGIKA
        if (($user->role !== $request->role) && ($request->role === 'siswa')) {
            // Cek apakah relasi guru ada sebelum menghapus
            if ($user->biodata->guru()->exists()) {
                $user->biodata->guru->delete();
            }

            // buat data di tabel siswa
            $siswa = new Siswa();
            $siswa->nis = $request->username;
            $siswa->biodata_id = $user->biodata->id;
            $siswa->kelas = 'Kosong';
            $siswa->save();
        }
        if (($user->role !== $request->role) && ($request->role === 'guru')) {
            // Cek apakah relasi siswa ada sebelum menghapus
            if ($user->biodata->siswa()->exists()) {
                $user->biodata->siswa->delete();
            }

            // buat data di table guru
            $guru = new Guru();
            $guru->nuptk = $request->username;
            $guru->biodata_id = $user->biodata->id;
            $guru->save();
        }

        if (($user->role !== $request->role) && ($request->role === 'admin')) {
            // Cek apakah relasi guru ada sebelum menghapus
            if ($user->biodata->guru()->exists()) {
                $user->biodata->guru->delete();
            }
            // Cek apakah relasi siswa ada sebelum menghapus
            if ($user->biodata->siswa()->exists()) {
                $user->biodata->siswa->delete();
            }
        }

        // UBAH DATA USER
        $userData = [
            'username' => $request->username,
            'role' => $request->role,
        ];

        // CEK JIKA ADA PASSWORD
        if (!empty($request->password)) {
            $userData['password'] = Hash::make($request->password);
        }

        // UPDATE USER
        $user->update($userData);

        Alert::success('Ubah User', 'Data user ' . $user->biodata->nama . ' berhasil diubah');
        return back();
    }

    public function destroy(User $user)
    {
        $user->biodata->delete();
        Storage::disk('public')->delete(Str::after($user->biodata->foto, 'storage/'));

        Alert::success('Hapus User', 'Data user ' . $user->biodata->nama . ' berhasil dihapus');
        return back();
    }
}
