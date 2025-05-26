<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_user'); // Harus Integer Unsigned
            $table->unsignedInteger('id_sub_kriteria');
            $table->timestamps();

            $table->foreign('id_user')
                ->references('id_user')->on('users')
                ->onDelete('cascade');

            $table->foreign('id_sub_kriteria')
                ->references('id_sub_kriteria')->on('sub_kriteria')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian');
    }
};
