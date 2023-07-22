<?php

namespace App\Console\Commands;

use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class KirimPesanWhatsApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'whatsapp:kirim';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kirim pesan WhatsApp berdasarkan jadwal konseling';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tanggal = Carbon::now('Asia/Makassar')->toDateString();
        $jam = Carbon::now('Asia/Makassar')->format('H:i');
        $jadwal = Jadwal::where('tanggal_konseling', $tanggal)
            ->where('jam_konseling', $jam)
            ->first();

        if ($jadwal) {
            $nomorGuru = $jadwal->guru->biodata->telepon;
            $toGuru = "Assalamu'alaikum ini adalah pesan pengingat otomatis menggunakan nomor admin. Mohon maaf telah mengganggu waktunya.\n";
            $toGuru .= "Bapak / Ibu : " . $jadwal->guru->biodata->nama . "\n";
            $toGuru .= "NUPTK : " . $jadwal->guru->nuptk . "\n";
            $toGuru .= "memiliki jadwal konseling pada hari ini.\n\n";
            $toGuru .= "Tanggal : " . $jadwal->tanggal_konseling . "\n";
            $toGuru .= "Jam : " . $jadwal->jam_konseling . "\n";
            $toGuru .= "Kepada siswa berikut \n\n";
            $toGuru .= "Nama : " . $jadwal->siswa->biodata->nama . "\n";
            $toGuru .= "NIS : " . $jadwal->siswa->nis . ".\n";
            $toGuru .= "Untuk lebih lanjut, Bapak / Ibu dapat menghubungi siswa tersebut pada kontak berikut : \n\n";
            $toGuru .= "Nomor WA : " . $jadwal->siswa->biodata->telepon;

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
                    'target' => $nomorGuru,
                    'message' => $toGuru,
                ),
                CURLOPT_HTTPHEADER => array(
                    "Authorization: $token"
                ),
            ));

            curl_exec($curl);

            // Lakukan Update Status Jadwal
            $jadwal->update([
                'status' => 'berlangsung',
            ]);

            return redirect()->route('jadwal.index');
        }
    }
}
