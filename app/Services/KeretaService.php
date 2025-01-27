<?php

namespace App\Services;

use App\Models\Kereta;

class KeretaService
{
  public function validateKeretaRequest($fields)
  {
    return $fields->validate([
      'nama_kereta' => 'required|string',
      'deskripsi' => 'required|string',
      'kelas' => 'required|string',
    ]);
  }

  public function getKereta($id = null)
  {
    if ($id) {
      return Kereta::find($id);
    }
    return Kereta::all();
  }

  public function createKereta($fields)
  {
    $fields = $this->validateKeretaRequest($fields);
    return Kereta::create($fields);
  }

  public function updateKereta($fields, $id)
  {
    $kereta = Kereta::find($id);
    if ($kereta) {
      $kereta->update($fields->all());
      return $kereta;
    }
    return null;
  }

  public function deleteKereta($id)
  {
    $kereta = Kereta::find($id);
    if ($kereta) {
      $kereta->delete();
      return true;
    }
    return false;
  }
}
