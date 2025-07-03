<?php

namespace App\Services;

use App\Models\User;
use App\Models\Pelanggan;
use App\Models\Petugas;
use Illuminate\Http\Request;

class UserService
{
  public function validateUserRequest($fields)
  {
    return $fields->validate([
      'name' => 'required|string',
      'username' => 'required|string|unique:users,username',
      'email' => 'required|string|email|unique:users,email',
      'password' => 'required|string|min:8',
      'remember_token' => 'nullable|string|max:100',
    ]);
  }

  public function validatePelanggan($fields)
  {
    return $fields->validate([
      'NIK' => 'required|string|max:100|unique:pelanggan,NIK',
      'alamat' => 'required|string',
      'telp' => 'required|string|max:20',
    ]);
  }

  public function validatePetugas($fields)
  {
    return $fields->validate([
      'alamat' => 'required|string',
      'telp' => 'required|string|max:20',
    ]);
  }

  public function getUser($id = null)
  {
    if ($id) {
      return User::find($id);
    }
    return User::all();
  }

  public function getUserByEmail($email)
  {
    return User::where('email', $email)->first();
  }

  public function createPelanggan($fields)
  {
    $userFields = $this->validateUserRequest($fields);
    $userFields['role'] = 'pelanggan';
    $pelangganFields = $this->validatePelanggan($fields);
    $createdUser = User::create($userFields);
    $pelangganFields['id_user'] = $createdUser->id;
    $pelangganFields['nama_penumpang'] = $createdUser->username;
    Pelanggan::create($pelangganFields);

    return $createdUser;
  }

  public function createPetugas($fields)
  {
    $userFields = $this->validateUserRequest($fields);
    $petugasFields = $this->validatePetugas($fields);
    $createdUser = User::create($userFields);
    $petugasFields['id_user'] = $createdUser->id;
    $petugasFields['nama_petugas'] = $createdUser->username;
    $createdPetugas = Petugas::create($petugasFields);
    $combinedData = array_merge($createdUser->toArray(), $createdPetugas->toArray());

    return $combinedData;
  }

  public function updatePelanggan($fields, $id)
  {

    $pelanggan = Pelanggan::find($id);


    if ($pelanggan) {
      $pelangganFields = $fields->validate([
        'NIK' => 'required|string|max:100|unique:pelanggan,NIK,' . $id,
        'alamat' => 'required|string',
        'telp' => 'required|string|max:20',
      ]);
      $user = User::find($pelanggan->id_user);
      $userFields = $fields->validate([
        'name' => 'required|string',
        'username' => 'required|string|unique:users,username,' . $pelanggan->id_user,
        'email' => 'required|string|email|unique:users,email,' . $pelanggan->id_user,
        'remember_token' => 'nullable|string|max:100',
      ]);
      $pelanggan->update($pelangganFields);
      $user->update($userFields);

      return $pelanggan;
    }
    return null;
  }

  public function updateUser(Request $fields, $id)
  {
    $user = User::find($id);
    if ($user) {
      $user->update($fields->all());
      return $user;
    }
    return null;
  }

  public function deleteUser($id)
  {
    $user = User::find($id);
    if ($user) {
      $user->delete();
      return true;
    }
    return false;
  }
}
