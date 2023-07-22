<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

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

    // TAMABAHAN UNTUK SISWA
    public function konsultasi()
    {
        $gurus = Guru::paginate(5);
        return view('siswa.konsultasi.index', compact('gurus'));
    }

    public function kirimPesan(Request $request, $id)
    {
        $this->validate($request, [
            'pesan' => 'required',
        ]);
        $guru = Guru::findOrFail($id);
        $telepon = $guru->biodata->telepon;
        $pesan = "Chat Siswa \n================\n" . $request->pesan . "\n================\n\n";
        $pesan .= "Chat Boot \n==================== \nSelanjutnya bapak / ibu guru dapat merespon pesan siswa di nomor berikut \n\n";
        $pesan .= "Nama : " . auth()->user()->biodata->nama . "\n";
        $pesan .= "WhatsApp : " . auth()->user()->biodata->telepon . "\n\n";
        $pesan .= "Terimakasih dan maaf jika terdapat salah kata.\n";
        $pesan .= "Salam manis dari SYSTEM CYBCO\n";

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

        Alert::success('Chat WhatsApp', 'Chat anda berhasil dikirim');

        return redirect()->route('konsultasi');
    }
}
