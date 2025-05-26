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
        Schema::create('alternatif', function (Blueprint $table) {
            $table->increments('id_alternatif');
            $table->string('keterangan', 20);
            $table->integer('tahun');
            $table->string('nik', 30);
            $table->string('nama', 100);
            $table->string('jenis_kelamin', 50);
            $table->string('departemen', 100);
            $table->string('email', 50);
            $table->string('no_telp', 50);
            $table->string('alamat', 500);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alternatif');
    }
};
