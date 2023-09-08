<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuisioner extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'pertanyaan_id',
        'jawaban',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class);
    }
}
