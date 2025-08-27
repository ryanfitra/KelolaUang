<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'verified'])->group(function () {

    // Admin dashboard
    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])
            ->name('admin.dashboard');
    });
    

    // Peserta dashboard
    Route::prefix('peserta')->middleware('role:peserta')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Peserta\DashboardController::class, 'index'])
            ->name('peserta.dashboard');
        Route::get('/lamaran', [App\Http\Controllers\Peserta\LamaranController::class, 'index'])
            ->name('peserta.lamaran');
    });
});

// Route::middleware('auth')->group(function () {
//     Route::get('/dashboard-2', function () {
//         return view('dashboard-2');
//     })->name('dashboard-2');
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
