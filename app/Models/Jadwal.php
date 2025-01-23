<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $fillable = [
        'asal_keberangkatan',
        'tujuan_keberangkatan',
        'tanggal_keberangkatan',
        'tanggal_kedatangan',
        'harga',
        'id_kereta'
    ];

    public function kereta()
    {
        return $this->belongsTo(Kereta::class, 'id_kereta');
    }

    public function pembelian_tiket()
    {
        return $this->hasMany(PembelianTiket::class, 'id_jadwal');
    }
}
