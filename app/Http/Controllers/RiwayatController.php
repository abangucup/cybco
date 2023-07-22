<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Riwayat;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class RiwayatController extends Controller
{
    // UNTUK ROLE SISWA
    public function riwayatSiswa()
    {
        // $riwayats = Riwayat::paginate(5);
        $siswa = Siswa::where('id', auth()->user()->biodata->siswa->id)->first();
        $riwayats = $siswa->riwayat()->paginate(5);
        return view('siswa.riwayat.index', compact('riwayats'));
    }

    // ROLE GURU
    public function index()
    {
        $riwayats = Riwayat::paginate(5);
        $jadwals = Jadwal::doesntHave('riwayat')->get();
        return view('guru.riwayat.index', compact('riwayats', 'jadwals'));
    }

    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'jadwal' => 'required',
            'keterangan' => 'required',
        ]);

        if ($validasi->fails()) {
            Alert::error('Error', 'Riwayat gagal ditambahkan');
            return back();
        }

        $riwayat = new Riwayat();
        $riwayat->jadwal_id = $request->jadwal;
        $riwayat->keterangan = $request->keterangan;
        $riwayat->save();

        Alert::success('Success', 'Riwayat berhasil ditambahkan');

        // UBAH STATUS JADWAL
        $jadwal = Jadwal::findOrFail($request->jadwal);
        $jadwal->update([
            'status' => 'selesai',
        ]);

        // KIRIM PESAN KE ORANG TUA DENGNA HASIL KONSELING TERSEBUT
        $telepon = $jadwal->siswa->telepon_ortu;
        $pesan = "Selamat Pagi/Siang/Sore/Malam\n";
        $pesan .= "Mohon maaf sebelumnya bapak / ibu " . $jadwal->siswa->nama_ortu . " orang tua dari siswa bernama " . $jadwal->siswa->biodata->nama . "\n";
        $pesan .= "Kami dari pihak sekolah menginformasikan bahwa anak dari bapak / ibu sebelumnya telah melakukan konseling dikarenakan siswa tersebut memiliki beberapa permasalahan\n";
        $pesan .= "Sehingganya kami dari pihak sekola melakukan konseling. Adapun hasil dari konseling sebagai berikut :\n\n";
        $pesan .= "=====Hasil Konseling=====\n" . $riwayat->keterangan . "\n===============\n";
        $pesan .= "Sekian dari kami pihak sekolah, jika ada pertanyaan atau solusi bisa menghubungi nomor gurunya sebagai berikut\n\n";
        $pesan .= "Nama Guru : " . $jadwal->guru->biodata->nama . "\n";
        $pesan .= "Nomor WA : " . $jadwal->guru->biodata->telepon . "\n";

        $token = env('FONNTE_API_KEY');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $telepon,
                'message' => $pesan,
            ),
            CURLOPT_HTTPHEADER => array(
                "Authorization: $token"
            ),
        ));

        curl_exec($curl);

        return redirect()->back();
    }

    public function show($id)
    {
        $riwayat = Riwayat::findOrFail($id);
        return view('guru.riwayat.detail', compact('riwayat'));
    }

    public function destroy(Riwayat $riwayat)
    {
        $riwayat->delete();
        Alert::success('Hapus', 'Riwayat berhasil dihapus');
        return redirect()->back();
    }
}
