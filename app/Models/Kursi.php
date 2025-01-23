<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kursi extends Model
{
    protected $table = 'kursi';
    protected $fillable = [
        'no_kursi',
        'id_gerbong',
    ];

    public function gerbong()
    {
        return $this->belongsTo(Gerbong::class, 'id_gerbong');
    }

    public function pembelian_tiket()
    {
        return $this->hasMany(PembelianTiket::class, 'id_kursi');
    }
}
