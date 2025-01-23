<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gerbong extends Model
{
    protected $table = 'gerbong';
    protected $fillable = [
        'nama_gerbong',
        'kuota',
        'id_kereta',
    ];


    public function kereta()
    {
        return $this->belongsTo(Kereta::class, 'id_kereta');
    }

    public function kursi()
    {
        return $this->hasMany(Kursi::class, 'id_gerbong');
    }
}
