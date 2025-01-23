<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = DB::table('users')->where('email', 'admin@gmail.com')->value('id');
        DB::table('petugas')->insert([
            'nama_petugas' => 'admin',
            'alamat' => 'jalan jalan',
            'telp' => '768013809890',
            'id_user' => $userId,
        ]);
    }
}
