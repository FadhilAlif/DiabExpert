<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PenyakitController;
use App\Http\Controllers\UserController;
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
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

// Rute untuk diagnosa yang bisa diakses oleh user tanpa login
Route::prefix('/diagnosa')->group(function () {
    Route::get('/', [DiagnosaController::class, 'index']);
    Route::post('/create-pasien', [DiagnosaController::class, 'createPasien']);
    Route::get('/pilih-gejala', [DiagnosaController::class, 'pilihGejala']);
    Route::get('/pilih', [DiagnosaController::class, 'pilih']);
    Route::post('/update-kondisi', [DiagnosaController::class, 'updateKondisi']);
    Route::get('/hapus-gejala', [DiagnosaController::class, 'hapusGejalaTerpilih']);
    Route::get('/proses', [DiagnosaController::class, 'prosesDiagnosa']);
    Route::get('/keputusan/{id}', [DiagnosaController::class, 'keputusan']);
    Route::get('/pasien/cetak/{id}', [PasienController::class, 'print']);
});
// Rute admin yang membutuhkan login untuk mengakses fitur lainnya
Route::prefix('/admin')->middleware('auth')->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', function () {
        return view('admin.layouts.wrapper');
    });

    Route::resource('/pasien', PasienController::class);
    Route::resource('/user', UserController::class);
    Route::resource('/gejala', GejalaController::class);
    Route::resource('/penyakit', PenyakitController::class);
    Route::post('/penyakit/add-gejala', [PenyakitController::class, 'addGejala']);
    Route::delete('/penyakit/delete-role/{id}', [PenyakitController::class, 'deleteRole']);
});
