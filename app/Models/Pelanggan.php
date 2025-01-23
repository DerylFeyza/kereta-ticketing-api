<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $fillable = [
        'NIK',
        'nama_penumpang',
        'alamat',
        'telp',
        'id_user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function pembelian_tiket()
    {
        return $this->hasMany(PembelianTiket::class, 'id_pelanggan');
    }
}
