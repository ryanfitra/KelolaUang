<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// login
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.attempt');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->middleware('auth')->name('logout');


Route::middleware(['auth', 'verified'])->group(function () {

    // Admin dashboard
    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])
            ->name('admin.dashboard');

        // Route::prefix('peserta')->group(function () {
        //     Route::get('/', [App\Http\Controllers\Admin\PesertaUjianController::class, 'index'])->name('admin.peserta-ujian.index');
        //     Route::get('/tambah', [App\Http\Controllers\Admin\PesertaUjianController::class, 'tambah'])->name('admin.peserta-ujian.tambah');
        //     Route::post('/store', [App\Http\Controllers\Admin\PesertaUjianController::class, 'store'])->name('admin.peserta-ujian.store');
        //     // Route::delete('/hapus/{id}', [App\Http\Controllers\Admin\PesertaUjianController::class, 'destroy'])->name('admin.peserta-ujian.delete');
        //     Route::delete('/delete/{peserta}', [App\Http\Controllers\Admin\PesertaUjianController::class, 'destroy'])->name('admin.peserta-ujian.delete');
        // });

        Route::prefix('pendaftar')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\PendaftarController::class, 'index'])->name('admin.pendaftar.index');
            Route::post('/generate/{id}', [App\Http\Controllers\Admin\PendaftarController::class, 'generate'])->name('admin.pendaftar.generate');
            Route::post('/generate-all', [App\Http\Controllers\Admin\PendaftarController::class, 'generateAll'])->name('admin.pendaftar.generateAll');
            Route::get('/tambah', [App\Http\Controllers\Admin\PendaftarController::class, 'tambah'])->name('admin.pendaftar.tambah');
            Route::post('/store', [App\Http\Controllers\Admin\PendaftarController::class, 'store'])->name('admin.pendaftar.store');
            Route::post('/upload', [App\Http\Controllers\Admin\PendaftarController::class, 'upload'])->name('admin.pendaftar.upload');
            Route::delete('/delete/{peserta}', [App\Http\Controllers\Admin\PendaftarController::class, 'destroy'])->name('admin.pendaftar.delete');
        });

        Route::prefix('jenis-ujian')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\JenisUjianController::class, 'index'])->name('admin.jenis-ujian.index');
            Route::get('/create', [App\Http\Controllers\Admin\JenisUjianController::class, 'create'])->name('admin.jenis-ujian.tambah');
            Route::post('/store', [App\Http\Controllers\Admin\JenisUjianController::class, 'store'])->name('admin.jenis-ujian.store');
            Route::get('/{jenisUjian}/edit', [App\Http\Controllers\Admin\JenisUjianController::class, 'edit'])
                ->name('admin.jenis-ujian.edit');
            Route::patch('/{jenisUjian}', [App\Http\Controllers\Admin\JenisUjianController::class, 'update'])
                ->name('admin.jenis-ujian.update');
            Route::delete('/delete/{id}', [App\Http\Controllers\Admin\JenisUjianController::class, 'destroy'])->name('admin.jenis-ujian.delete');
        });

        Route::prefix('jadwal-ujian')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\JadwalUjianController::class, 'index'])->name('admin.jadwal-ujian.index');
            Route::get('/create', [App\Http\Controllers\Admin\JadwalUjianController::class, 'create'])->name('admin.jadwal-ujian.tambah');
            Route::post('/store', [App\Http\Controllers\Admin\JadwalUjianController::class, 'store'])->name('admin.jadwal-ujian.store');
            Route::get('/{jadwalUjian}/edit', [App\Http\Controllers\Admin\JadwalUjianController::class, 'edit'])
                ->name('admin.jadwal-ujian.edit');
            Route::patch('/{jadwalUjian}', [App\Http\Controllers\Admin\JadwalUjianController::class, 'update'])
                ->name('admin.jadwal-ujian.update');

            // Route::post('/jadwal-ujian/store', [JadwalUjianController::class, 'store'])->name('admin.jadwal-ujian.store');

            // Route::delete('/hapus/{id}', [App\Http\Controllers\Admin\PesertaUjianController::class, 'destroy'])->name('admin.peserta-ujian.delete');
            Route::delete('/delete/{id}', [App\Http\Controllers\Admin\JadwalUjianController::class, 'destroy'])->name('admin.jadwal-ujian.delete');
        });

        Route::prefix('peserta-ujian')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\PesertaUjianController::class, 'index'])->name('admin.peserta-ujian.index');
            Route::post('/{id}/verifikasi', [App\Http\Controllers\Admin\PesertaUjianController::class, 'verifikasi'])->name('admin.peserta-ujian.verifikasi');
            Route::get('/tambah', [App\Http\Controllers\Admin\PesertaUjianController::class, 'tambah'])->name('admin.peserta-ujian.tambah');
            Route::post('/store', [App\Http\Controllers\Admin\PesertaUjianController::class, 'store'])->name('admin.peserta-ujian.store');
            // Route::delete('/hapus/{id}', [App\Http\Controllers\Admin\PesertaUjianController::class, 'destroy'])->name('admin.peserta-ujian.delete');
            Route::post('/upload', [App\Http\Controllers\Admin\PesertaUjianController::class, 'upload'])->name('admin.peserta-ujian.status.upload');
            Route::delete('/delete/{id}', [App\Http\Controllers\Admin\PesertaUjianController::class, 'destroy'])->name('admin.peserta-ujian.delete');
        });

        Route::prefix('jabatan')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\JabatanController::class, 'index'])->name('admin.jabatan.index');
            Route::get('/create', [App\Http\Controllers\Admin\JabatanController::class, 'create'])->name('admin.jabatan.tambah');
            Route::post('/store', [App\Http\Controllers\Admin\JabatanController::class, 'store'])->name('admin.jabatan.store');
            Route::get('/{jabatan}/edit', [App\Http\Controllers\Admin\JabatanController::class, 'edit'])->name('admin.jabatan.edit');
            Route::patch('/{jabatan}', [App\Http\Controllers\Admin\JabatanController::class, 'update'])->name('admin.jabatan.update');
            Route::post('/upload', [App\Http\Controllers\Admin\JabatanController::class, 'upload'])->name('admin.jabatan.upload');
            Route::delete('/delete/{id}', [App\Http\Controllers\Admin\JabatanController::class, 'destroy'])->name('admin.jabatan.delete');
        });

    });
    

    // Peserta dashboard
    Route::prefix('peserta')->middleware('role:peserta')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Peserta\DashboardController::class, 'index'])
            ->name('peserta.dashboard');
        
        
        Route::prefix('lamaran')->group(function () {
            Route::get('/', [App\Http\Controllers\Peserta\LamaranController::class, 'index'])
            ->name('peserta.lamaran');
            Route::get('/download-kartu-peserta/{customId}', [App\Http\Controllers\Peserta\LamaranController::class, 'download_kartu'])
                ->name('peserta.download-kartu-peserta');
        });

        Route::prefix('profil-perusahaan')->group(function () {
            Route::get('/', [App\Http\Controllers\ProfilController::class, 'index'])
            ->name('peserta.profil-pt');
        });

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
