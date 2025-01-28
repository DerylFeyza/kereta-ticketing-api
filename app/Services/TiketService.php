<?php

namespace App\Services;

use App\Models\PembelianTiket;
use App\Models\Pelanggan;

class TiketService
{
  public function validateTiketRequest($fields)
  {
    return $fields->validate([
      'tanggal_pembelian' => 'required|date',
      'id_jadwal' => 'required|exists:jadwal,id',
      'id_kursi' => 'required|exists:kursi,id',
    ]);
  }

  public function getUserTikets($user)
  {
    $userId = $user->id;
    $query = PembelianTiket::where('user_id', $userId);
    return $query->orderBy('created_at', 'desc')->cursorPaginate(15);
  }

  public function findTiketById($id)
  {
    return PembelianTiket::find($id);
  }

  public function createTiket($fields)
  {
    $validatedData = $this->validateTiketRequest($fields);
    $pelanggan = Pelanggan::where("id_user", $fields->user()->id)->first();
    $validatedData['id_pelanggan'] = $pelanggan->id;
    return PembelianTiket::create($validatedData);
  }

  public function updateTiket($fields, $id)
  {
    $jadwal = PembelianTiket::find($id);
    if ($jadwal) {
      $jadwal->update($fields->all());
      return $jadwal;
    }
    return null;
  }

  public function deleteTiket($id)
  {
    $jadwal = PembelianTiket::find($id);
    if ($jadwal) {
      $jadwal->delete();
      return true;
    }
    return false;
  }
}
