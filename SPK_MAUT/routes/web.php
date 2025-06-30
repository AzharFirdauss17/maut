<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\SubKriteriaController;
use App\Http\Controllers\LoanRequestController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group.
|
*/

// Halaman Utama
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Login & Logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Semua user harus login
Route::middleware(['auth'])->group(function () {

    // Dashboard berdasarkan role
    Route::get('/dashboard', function () {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    })->name('dashboard');

    // Admin Dashboard
    Route::middleware(['is_admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        
        // Resource Kriteria & Subkriteria
        Route::resource('kriteria', KriteriaController::class);
        Route::resource('subkriteria', SubKriteriaController::class);
        Route::get('/maut/hitung-bobot', [KriteriaController::class, 'hitungBobotSemuaKriteria'])->name('maut.hitung');
        Route::resource('penilaian', PenilaianController::class)->only(['index', 'create', 'store']);

        // Pinjaman (Admin)
        Route::get('/admin/pinjaman', [AdminController::class, 'index'])->name('admin.pinjaman.index');
        Route::post('/admin/pinjaman/acc/{id}', [AdminController::class, 'acc'])->name('admin.pinjaman.acc');
        Route::post('/admin/pinjaman/tolak/{id}', [AdminController::class, 'reject'])->name('admin.pinjaman.tolak');
    });

    // User Dashboard
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');

    // Pengajuan Pinjaman (User)
    Route::get('/pinjaman', [LoanRequestController::class, 'create'])->name('loan.create');
    Route::post('/pinjaman', [LoanRequestController::class, 'store'])->name('loan.store');
    Route::get('/pinjaman/success', function () {
        return view('loan.success');
    })->name('loan.success');


    Route::get('/pinjaman/pdf/{id}', [LoanRequestController::class, 'generatePDF'])->name('pinjaman.pdf');
});