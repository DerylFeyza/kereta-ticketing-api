<?php

namespace App\Services;

use App\Models\Jadwal;

class JadwalService
{
  public function validateJadwalRequest($fields)
  {
    return $fields->validate([
      'asal_keberangkatan' => 'required|string|max:100',
      'tujuan_keberangkatan' => 'required|string|max:100',
      'tanggal_keberangkatan' => 'required|date',
      'tanggal_kedatangan' => 'required|date|after_or_equal:tanggal_keberangkatan',
      'harga' => 'required|numeric|min:1000',
      'id_kereta' => 'required|exists:kereta,id',
    ]);
  }

  public function getJadwals($search = null, $datetime = null)
  {
    $query = Jadwal::query();

    if ($search) {
      $query->where('asal_keberangkatan', 'like', '%' . $search . '%')
        ->orWhere('tujuan_keberangkatan', 'like', '%' . $search . '%');
    }

    if ($datetime) {
      $query->whereDate('tanggal_keberangkatan', $datetime);
    }

    return $query->orderBy('created_at', 'desc')->cursorPaginate(15);
  }

  public function findJadwalById($id)
  {
    return Jadwal::find($id);
  }

  public function createJadwal($fields)
  {
    $fields = $this->validateJadwalRequest($fields);
    return Jadwal::create($fields);
  }

  public function updateJadwal($fields, $id)
  {
    $jadwal = Jadwal::find($id);
    if ($jadwal) {
      $jadwal->update($fields->all());
      return $jadwal;
    }
    return null;
  }

  public function deleteJadwal($id)
  {
    $jadwal = Jadwal::find($id);
    if ($jadwal) {
      $jadwal->delete();
      return true;
    }
    return false;
  }
}
