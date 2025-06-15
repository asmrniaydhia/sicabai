<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Bengkel\BengkelController;
use App\Http\Controllers\Bengkel\BengkelServiceController;
use App\Http\Controllers\Bengkel\BengkelTambalBanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'userMiddleware'])->group(function(){
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/edukasi', [UserController::class, 'edukasi'])->name('user.edukasi');
    Route::get('/diagnosa', [UserController::class, 'diagnosa'])->name('user.diagnosa');
    Route::get('/riwayat', [UserController::class, 'riwayat'])->name('user.riwayat');
});

Route::middleware(['auth', 'adminMiddleware'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/sparepart', [AdminController::class, 'sparepart'])->name('admin.sparepart');
    Route::get('/admin/user', [AdminController::class, 'user'])->name('admin.user');
    Route::get('/admin/bengkel', [AdminController::class, 'bengkel'])->name('admin.bengkel');

    Route::post('/admin/sparepart', [AdminController::class, 'storeSparepart'])->name('admin.sparepart.store');
    Route::get('/admin/sparepart/{id}/edit', [AdminController::class, 'editSparepart'])->name('sparepart.edit');
    Route::put('/admin/sparepart/{id}', [AdminController::class, 'updateSparepart'])->name('sparepart.update');
    Route::delete('/admin/sparepart/{id}', [AdminController::class, 'destroySparepart'])->name('sparepart.destroy');
});

Route::middleware(['auth', 'bengkelMiddleware'])->group(function () {
    Route::get('/bengkel/input-toko', [BengkelController::class, 'create'])->name('bengkel.input-toko');
    Route::post('/bengkel/input-toko', [BengkelController::class, 'store'])->name('bengkel.input-toko.store');
});

// Group untuk Bengkel Service
Route::middleware(['auth', 'bengkelService'])->group(function () {
    Route::get('/bengkelService/dashboard', [BengkelServiceController::class, 'index'])->name('bengkelService.dashboard');
});

// Group untuk Tambal Ban
Route::middleware(['auth', 'tambalBan'])->group(function () {
    Route::get('/tambalBan/dashboard', [BengkelTambalBanController::class, 'index'])->name('tambalBan.dashboard');
});

