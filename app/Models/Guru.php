<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $fillable = [
        'nuptk',
        'biodata_id',
    ];

    public function biodata()
    {
        return $this->belongsTo(Biodata::class);
    }
}
