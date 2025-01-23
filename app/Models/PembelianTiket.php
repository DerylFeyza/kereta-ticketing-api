<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembelianTiket extends Model
{
    protected $table = 'pembelian_tiket';
    protected $fillable = [
        'tanggal_pembelian',
        'id_pelanggan',
        'id_jadwal',
        'id_kursi',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal');
    }

    public function kursi()
    {
        return $this->belongsTo(Kursi::class, 'id_kursi');
    }
}
