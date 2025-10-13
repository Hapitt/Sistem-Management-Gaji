<?php

use App\Http\Controllers\GajiController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\LemburController;
use App\Http\Controllers\ProfileController;


use Illuminate\Support\Facades\Route;

use function Ramsey\Uuid\v1;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');




Route::resource('karyawan', KaryawanController::class);
Route::resource('jabatan', JabatanController::class);
Route::resource('rating', RatingController::class);
Route::resource('lembur', LemburController::class);
Route::get('gaji/calculate', [GajiController::class, 'calculate'])->name('gaji.calculate');
Route::get('/gaji/cetak/{id}', [GajiController::class, 'cetak'])->name('gaji.cetak');

Route::resource('gaji', GajiController::class);

