<?php

namespace App\Services;

use App\Models\Gerbong;

class GerbongService
{
  public function validateGerbongRequest($fields)
  {
    return $fields->validate([
      'nama_gerbong' => 'required|string',
      'kuota' => 'required|integer',
      'id_kereta' => 'required|exists:kereta,id',
    ]);
  }

  public function getGerbong($id = null)
  {
    if ($id) {
      return Gerbong::find($id);
    }
    return Gerbong::all();
  }

  public function createGerbong($fields)
  {
    $fields = $this->validateGerbongRequest($fields);
    return Gerbong::create($fields);
  }

  public function updateGerbong($fields, $id)
  {
    $gerbong = Gerbong::find($id);
    if ($gerbong) {
      $gerbong->update($fields->all());
      return $gerbong;
    }
    return null;
  }

  public function deleteGerbong($id)
  {
    $gerbong = Gerbong::find($id);
    if ($gerbong) {
      $gerbong->delete();
      return true;
    }
    return false;
  }
}
