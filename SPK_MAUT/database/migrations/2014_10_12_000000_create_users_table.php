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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id_user'); // Pastikan ini adalah id_user
            $table->integer('id_user_level')->unsigned();
            $table->string('nama', 200);
            $table->string('email', 100);
            $table->string('username', 100);
            $table->string('password', 100);
            $table->foreign('id_user_level')->references('id_user_level')->on('user_level')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
