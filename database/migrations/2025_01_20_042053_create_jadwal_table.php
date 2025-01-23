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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->string('asal_keberangkatan', 100);
            $table->string('tujuan_keberangkatan', 100);
            $table->date('tanggal_keberangkatan');
            $table->date('tanggal_kedatangan');
            $table->double('harga');
            $table->foreignId('id_kereta')->constrained('kereta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
