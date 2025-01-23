<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kereta extends Model
{
    protected $table = 'kereta';
    protected $fillable = [
        'nama_kereta',
        'deskripsi',
        'kelas',
    ];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_kereta');
    }

    public function gerbong()
    {
        return $this->hasMany(Gerbong::class, 'id_kereta');
    }
}
