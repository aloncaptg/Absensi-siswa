<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruAbsensiController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

	Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('dashboard.admin')->middleware('role:admin');
	Route::get('/dashboard/guru',  [DashboardController::class, 'guru'])->name('dashboard.guru')->middleware('role:guru');
	Route::get('/dashboard/siswa', [DashboardController::class, 'siswa'])->name('dashboard.siswa')->middleware('role:siswa');

	Route::resource('/absensi', AbsensiController::class);
	Route::resource('/guru-absensi', GuruAbsensiController::class);
	Route::resource('/kelas', KelasController::class);
	Route::get('/laporan', [AbsensiController::class, 'laporan'])->name('laporan');
	Route::get('/laporan/pdf', [AbsensiController::class, 'laporanPdf'])->name('laporan.pdf');
	Route::get('/laporan-guru', [GuruAbsensiController::class, 'laporan'])->name('laporan.guru');
	Route::get('/laporan-guru/pdf', [GuruAbsensiController::class, 'laporanPdf'])->name('laporan.guru.pdf');

	// Sosmed (single tab/page)
	Route::get('/sosmed', function () {
		return view('sosmed.index');
	})->name('sosmed');

	// Profile
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
