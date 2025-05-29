<?php

use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\ObatController;
use App\Http\Controllers\Admin\PegawaiController;
use App\Http\Controllers\Admin\TindakanController;
use App\Http\Controllers\Admin\UserController;
// use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\WilayahController;
use App\Http\Controllers\Dokter\TransaksiController;
use App\Http\Controllers\Kasir\PembayaranController;
use App\Http\Controllers\Petugas\PendaftaranController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('wel');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('wilayah', WilayahController::class);
    Route::resource('users', UserController::class);
    Route::resource('pegawais', PegawaiController::class);
    Route::resource('tindakans', TindakanController::class);
    Route::resource('obats', ObatController::class);
    Route::get('/laporans', [LaporanController::class, 'index'])->name('laporans.index');
    Route::get('/laporans/export-pdf', [LaporanController::class, 'exportPdf'])->name('laporans.export-pdf');
});

Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/dashboard', fn() => view('petugas.dashboard'))->name('dashboard');
    Route::resource('pendaftarans', PendaftaranController::class)->only(['index', 'create', 'store']);
    Route::get('pendaftarans/pasien/create', [PendaftaranController::class, 'createPasien'])->name('pendaftarans.create-pasien');
    Route::post('pendaftarans/pasien', [PendaftaranController::class, 'storePasien'])->name('pendaftarans.store-pasien');
});

Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->name('dokter.')->group(function () {
    Route::get('/dashboard', fn() => view('dokter.dashboard'))->name('dashboard');
    Route::resource('transaksis', TransaksiController::class)->only(['index', 'create', 'store']);
});

Route::middleware(['auth', 'role:kasir'])->prefix('kasir')->name('kasir.')->group(function () {
    Route::get('/dashboard', fn() => view('kasir.dashboard'))->name('dashboard');
    Route::resource('pembayarans', PembayaranController::class)->only(['index', 'show', 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
