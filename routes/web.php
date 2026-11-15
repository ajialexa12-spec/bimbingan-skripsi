<?php
use App\Http\Controllers\{AuthController, DashboardController, MahasiswaController, DosenController, SkripsiController, JadwalController, RiwayatController, LaporanController, PengaturanController};
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('dashboard'));
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/lupa-password', [AuthController::class, 'showForgot'])->name('password.request');
    Route::post('/lupa-password', [AuthController::class, 'resetPassword'])->name('password.update');
});
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('mahasiswa', MahasiswaController::class)->except(['show']);
    Route::resource('dosen', DosenController::class)->except(['show']);
    Route::resource('skripsi', SkripsiController::class)->except(['show']);
    Route::resource('jadwal', JadwalController::class)->except(['show']);
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/export', [LaporanController::class, 'export'])->name('laporan.export');
    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::put('/pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');
});
