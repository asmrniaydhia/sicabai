<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Bengkel\BengkelController;
use App\Http\Controllers\Bengkel\BengkelServiceController;
use App\Http\Controllers\Bengkel\BengkelTambalBanController;

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

Route::middleware(['auth', 'userMiddleware'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/bengkel/{id}/detail', [UserController::class, 'show'])->name('user.detail');
});

// Admin routes with proper naming
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::group(['middleware' => function ($request, $next) {
        if (auth()->user()->usertype !== 'admin') {
            abort(403, 'Akses ditolak');
        }
        return $next($request);
    }], function () {
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        // Users - Complete CRUD routes
        Route::get('/user', [AdminController::class, 'user'])->name('user');
        Route::post('/user', [AdminController::class, 'storeUser'])->name('user.store');
        Route::get('/user/{id}/edit', [AdminController::class, 'editUser'])->name('user.edit');
        Route::put('/user/{id}', [AdminController::class, 'updateUser'])->name('user.update');
        Route::delete('/user/{id}', [AdminController::class, 'destroyUser'])->name('user.destroy');
        // Route::get('/user/create', [AdminController::class, 'createUser'])->name('user.create'); // Uncomment if needed
        // Route::get('/user/{id}', [AdminController::class, 'showUser'])->name('user.show'); // Uncomment if needed

        // Sparepart
        Route::get('/sparepart', [AdminController::class, 'sparepart'])->name('sparepart');
        Route::post('/sparepart', [AdminController::class, 'storeSparepart'])->name('sparepart.store');
        Route::get('/sparepart/{id}/edit', [AdminController::class, 'editSparepart'])->name('sparepart.edit');
        Route::put('/sparepart/{id}', [AdminController::class, 'updateSparepart'])->name('sparepart.update');
        Route::delete('/sparepart/{id}', [AdminController::class, 'destroySparepart'])->name('sparepart.destroy');

        // Bengkel
        Route::get('/bengkel', [AdminController::class, 'bengkel'])->name('bengkel'); // Ensure this is defined
        Route::post('/bengkel', [AdminController::class, 'storeBengkel'])->name('bengkel.store');
        Route::get('/bengkel/{id}/edit', [AdminController::class, 'editBengkel'])->name('bengkel.edit');
        Route::put('/bengkel/{id}', [AdminController::class, 'updateBengkel'])->name('bengkel.update');
        Route::delete('/bengkel/{id}', [AdminController::class, 'destroyBengkel'])->name('bengkel.destroy');
    });
});

// Additional user routes (outside admin prefix) for compatibility
Route::middleware(['auth'])->group(function () {
    Route::group(['middleware' => function ($request, $next) {
        if (auth()->user()->usertype !== 'admin') {
            abort(403, 'Akses ditolak');
        }
        return $next($request);
    }], function () {
        Route::get('/user/{id}/edit', [AdminController::class, 'editUser'])->name('user.edit');
        Route::put('/user/{id}', [AdminController::class, 'updateUser'])->name('user.update');
        Route::delete('/user/{id}', [AdminController::class, 'destroyUser'])->name('user.destroy');
        Route::post('/user', [AdminController::class, 'storeUser'])->name('user.store');
    });
});

Route::middleware(['auth', 'bengkelMiddleware'])->group(function () {
    Route::get('/bengkel/input-toko', [BengkelController::class, 'create'])->name('bengkel.input-toko');
    Route::post('/bengkel/input-toko', [BengkelController::class, 'store'])->name('bengkel.input-toko.store');
});

Route::middleware(['auth', 'bengkelService'])->group(function () {
    Route::get('/bengkelService/dashboard', [BengkelServiceController::class, 'index'])->name('bengkelService.dashboard');
    Route::put('/bengkelService/{id}', [BengkelServiceController::class, 'update'])->name('bengkelService.update');

    Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
});

Route::middleware(['auth', 'tambalBan'])->group(function () {
    Route::get('/tambalBan/dashboard', [BengkelTambalBanController::class, 'index'])->name('tambalBan.dashboard');
    Route::get('/tambalBan/jasa', [BengkelTambalBanController::class, 'jasa'])->name('tambalBan.jasa');
    Route::put('/bengkelTambalBan/{id}', [BengkelTambalBanController::class, 'update'])->name('tambalBan.update');
});