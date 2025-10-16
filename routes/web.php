<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    DashboardController,
    ProfileController,
    KaryawanController,
    JabatanController,
    RatingController,
    LemburController,
    GajiController
};

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('gaji/calculate', [GajiController::class, 'calculate'])->name('gaji.calculate');
    Route::get('/gaji/cetak/{id}', [GajiController::class, 'cetak'])->name('gaji.cetak');

    Route::resource('karyawan', KaryawanController::class);
    Route::resource('jabatan', JabatanController::class);
    Route::resource('rating', RatingController::class);
    Route::resource('lembur', LemburController::class);
    Route::resource('gaji', GajiController::class);
});
