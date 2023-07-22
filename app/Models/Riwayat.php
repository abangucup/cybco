<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;

    protected $fillable = [
        'jadwal_id',
        'keterangan'
    ];

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    // public function siswa()
    // {
    //     return $this->belongsTo(Siswa::class);
    // }

    // public function guru()
    // {
    //     return $this->belongsTo(Guru::class);
    // }
}
