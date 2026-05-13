<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // tenant management routes
    Route::get('/tenant', [TenantController::class, 'index'])->name('tenant.index');
    Route::get('/tenant/create', [TenantController::class, 'create'])->name('tenant.create');
    Route::post('/tenant', [TenantController::class, 'store'])->name('tenant.store');
    Route::get('/tenant/{tenant}', [TenantController::class, 'show'])->name('tenant.show');
    Route::get('/tenant/{tenant}/edit', [TenantController::class, 'edit'])->name('tenant.edit');
    Route::put('/tenant/{tenant}', [TenantController::class, 'update'])->name('tenant.update');
    Route::delete('/tenant/{tenant}', [TenantController::class, 'destroy'])->name('tenant.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
