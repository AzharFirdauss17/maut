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
         Schema::create('hasil', function (Blueprint $table) {
            $table->increments('id_hasil');
            $table->integer('id_alternatif')->unsigned();
            $table->float('nilai', 10, 4);
            $table->foreign('id_alternatif')->references('id_alternatif')->on('alternatif')->onDelete('cascade');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil');
    }
};
