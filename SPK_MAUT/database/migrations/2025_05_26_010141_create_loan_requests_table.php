<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanRequestsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loan_requests', function (Blueprint $table) {
            $table->id('id_loan_request'); // Primary Key
            $table->unsignedInteger('id_user'); // Harus sama dengan tipe id_user di users
            $table->decimal('jumlah_dana', 10, 2); // Jumlah dana pinjaman
            $table->integer('jangka_waktu'); // Lama pengembalian dalam bulan
            $table->decimal('nilai_maut', 5, 2)->nullable(); // Hasil perhitungan MAUT
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();

            // Foreign Key
            $table->foreign('id_user')
                  ->references('id_user')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_requests');
    }
}