<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembelian_tiket', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pembelian');
            $table->foreignId('id_pelanggan')->constrained('pelanggan')->onDelete('cascade');
            $table->foreignId('id_jadwal')->constrained('jadwal')->onDelete('cascade');
            $table->foreignId('id_kursi')->constrained('kursi')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelian_tiket');
    }
};
