<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Bengkel\BengkelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'userMiddleware'])->group(function(){
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/edukasi', [UserController::class, 'edukasi'])->name('edukasi');
    Route::get('/diagnosa', [UserController::class, 'diagnosa'])->name('diagnosa');
    Route::get('/riwayat', [UserController::class, 'riwayat'])->name('riwayat');
});

Route::middleware(['auth', 'adminMiddleware'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', 'bengkelMiddleware'])->group(function () {
    Route::get('/bengkel/input-toko', [BengkelController::class, 'create'])->name('bengkel.input-toko');
    Route::post('/bengkel/input-toko', [BengkelController::class, 'store'])->name('bengkel.input-toko.store');
});

Route::middleware(['auth', 'bengkelService'])->get('/bengkel-service/dashboard', function () {
    return view('bengkelService.dashboard');
})->name('bengkelService.dashboard');

Route::middleware(['auth', 'tambalBan'])->get('/tambal-ban/dashboard', function () {
    return view('tambalBan.dashboard');
})->name('tambalBan.dashboard');
