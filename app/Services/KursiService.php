<?php

namespace App\Services;

use App\Models\Kursi;

class KursiService
{
  public function validateKursiRequest($fields)
  {
    return $fields->validate([
      'no_kursi' => 'required|integer',
      'id_gerbong' => 'required|exists:gerbong,id',
    ]);
  }

  public function getKursi($id = null)
  {
    if ($id) {
      return Kursi::find($id);
    }
    return Kursi::all();
  }

  public function createKursi($fields)
  {
    $fields = $this->validateKursiRequest($fields);
    $isNumberAvailable = Kursi::where('no_kursi', $fields['no_kursi'])->where('id_gerbong', $fields['id_gerbong'])->first();
    if ($isNumberAvailable) {
      return (object) [
        'success' => false,
        'message' => 'Kursi number already exists.'
      ];
    }
    return Kursi::create($fields);
  }

  public function updateKursi($fields, $id)
  {
    $kursi = Kursi::find($id);
    if ($kursi) {
      $kursi->update($fields->all());
      return $kursi;
    }
    return null;
  }

  public function deleteKursi($id)
  {
    $kursi = Kursi::find($id);
    if ($kursi) {
      $kursi->delete();
      return true;
    }
    return false;
  }
}
