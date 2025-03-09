<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDiagnosaController;
use App\Http\Controllers\AdminGejalaController;
use App\Http\Controllers\AdminPasienController;
use App\Http\Controllers\AdminPenyakitController;
use App\Http\Controllers\AdminUserController;
use Illuminate\Support\Facades\Route;

/*
|---------------------------------------------------------------------------
| Web Routes
|---------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Halaman utama (bisa disesuaikan)
Route::get('/', function () {
    return view('welcome');
});

// Rute login dan logout hanya untuk admin (guest hanya bisa login)
Route::get('/login', [AdminAuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AdminAuthController::class, 'login'])->middleware('guest');
Route::get('/logout', [AdminAuthController::class, 'logout'])->middleware('auth');

// Rute untuk diagnosa yang bisa diakses oleh user tanpa login
Route::prefix('/diagnosa')->group(function () {
    Route::get('/', [AdminDiagnosaController::class, 'index']);
    Route::post('/create-pasien', [AdminDiagnosaController::class, 'createPasien']);
    Route::get('/pilih-gejala', [AdminDiagnosaController::class, 'pilihGejala']);
    Route::get('/pilih', [AdminDiagnosaController::class, 'pilih']);
    Route::post('/update-kondisi', [AdminDiagnosaController::class, 'updateKondisi']);
    Route::get('/hapus-gejala', [AdminDiagnosaController::class, 'hapusGejalaTerpilih']);
    Route::get('/proses', [AdminDiagnosaController::class, 'prosesDiagnosa']);
    Route::get('/keputusan/{id}', [AdminDiagnosaController::class, 'keputusan']);
    Route::get('/pasien/cetak/{id}', [AdminPasienController::class, 'print']);
});
// Rute admin yang membutuhkan login untuk mengakses fitur lainnya
Route::prefix('/admin')->middleware('auth')->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', function () {
        return view('admin.layouts.wrapper');
    });

    Route::resource('/pasien', AdminPasienController::class);
    Route::resource('/user', AdminUserController::class);
    Route::resource('/gejala', AdminGejalaController::class);
    Route::resource('/penyakit', AdminPenyakitController::class);
    Route::post('/penyakit/add-gejala', [AdminPenyakitController::class, 'addGejala']);
    Route::delete('/penyakit/delete-role/{id}', [AdminPenyakitController::class, 'deleteRole']);
});
