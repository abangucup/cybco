<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'kelas',
        'nama_ortu',
        'telepon_ortu',
        'biodata_id',
    ];

    public function biodata()
    {
        return $this->belongsTo(Biodata::class);
    }

    public function kuisioner()
    {
        return $this->hasMany(Kuisioner::class);
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function riwayat()
    {
        return $this->hasManyThrough(Riwayat::class, Jadwal::class);
    }

    public function user()
    {
        return $this->hasOneThrough(User::class, Biodata::class);
    }
}
