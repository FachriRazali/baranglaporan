<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PerizinanController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\LoginController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [EmployeeController::class, 'index'])->name('admin.dashboard');
});


require __DIR__.'/auth.php';

require __DIR__.'/admin-auth.php';




Route::get('/', function () {
    return view('welcome');
});



// Employee Management

Route::get('/karyawan', [EmployeeController::class, 'index'])->name('employees.index');
Route::post('/karyawan', [EmployeeController::class, 'store'])->name('employees.store');
Route::get('/karyawan/{karyawan}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
Route::put('/karyawan/{karyawan}', [EmployeeController::class, 'update'])->name('employees.update');
Route::delete('/karyawan/{karyawan}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

// Perizinan Routes

Route::post('/perizinan', [PerizinanController::class, 'store'])->name('perizinan.store');
Route::get('/perizinan/create', [PerizinanController::class, 'create'])->name('perizinan.create');
Route::get('/perizinan', [PerizinanController::class, 'index']);
// Pengajuan Routes
Route::resource('pengajuan', PengajuanController::class);
Route::post('/pengajuan/store', [PengajuanController::class, 'store'])->name('pengajuan.store');

// Peminjaman Routes
Route::resource('peminjaman', PeminjamanController::class);

// Barang Routes
Route::resource('barang', BarangController::class);
Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
