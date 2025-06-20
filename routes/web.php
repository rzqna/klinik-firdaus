<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\SubkriteriaController; // Pastikan ini sudah ada
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Rute untuk user yang belum login
Route::middleware(['guest'])->group(function(){
    Route::get('/', [SesiController::class, 'index'])->name('login');
    Route::post('/', [SesiController::class, 'login']);
});

// Rute setelah user berhasil login. Laravel akan otomatis mengarah ke /home.
Route::get('/home', function(){
    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('dashboard.admin');
        } elseif (Auth::user()->role === 'user') {
            return redirect()->route('dashboard.user');
        }
    }
    // Fallback jika entah mengapa user terautentikasi tapi role tidak dikenal
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function(){

    Route::get('/logout', [SesiController::class, 'logout']);

    Route::prefix('admin/admin')->middleware(['userAkses:admin'])->group(function () {
        Route::get('/', [AdminController::class, 'admin'])->name('dashboard.admin');

        // Routes for User (Karyawan)
        Route::get('/datakaryawan', [UserController::class, 'index'])->name('datakaryawan.index');
        Route::get('/datakaryawan/create',[UserController::class, 'create'])->name('user.create');
        Route::post('/datakaryawan/store',[UserController::class, 'store'])->name('user.store');
        Route::get('/datakaryawan/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/datakaryawan/{user}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/datakaryawan/{user}', [UserController::class, 'destroy'])->name('user.destroy');

        // Routes for Kriteria
        Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
        Route::get('/kriteria/create',[KriteriaController::class, 'create'])->name('kriteria.create');
        Route::post('/kriteria/store',[KriteriaController::class, 'store'])->name('kriteria.store');
        Route::get('/kriteria/{kriteria}/edit', [KriteriaController::class, 'edit'])->name('kriteria.edit');
        Route::put('/kriteria/{kriteria}', [KriteriaController::class, 'update'])->name('kriteria.update');
        Route::delete('/kriteria/{kriteria}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');

        // Routes for Subkriteria (SUDAH BENAR)
        Route::get('/subkriteria', [SubkriteriaController::class, 'index'])->name('subkriteria.index');
        Route::get('/subkriteria/create',[SubkriteriaController::class, 'create'])->name('subkriteria.create');
        Route::post('/subkriteria/store',[SubkriteriaController::class, 'store'])->name('subkriteria.store');
        Route::get('/subkriteria/{subkriteria}/edit', [SubkriteriaController::class, 'edit'])->name('subkriteria.edit');
        Route::put('/subkriteria/{subkriteria}', [SubkriteriaController::class, 'update'])->name('subkriteria.update');
        Route::delete('/subkriteria/{subkriteria}', [SubkriteriaController::class, 'destroy'])->name('subkriteria.destroy');

        // Routes for Jabatan
        Route::get('/jabatan', [JabatanController::class, 'index'])->name('jabatan.index');
        Route::get('/jabatan/create',[JabatanController::class, 'create'])->name('jabatan.create');
        Route::post('/jabatan/store',[JabatanController::class, 'store'])->name('jabatan.store');
        Route::get('/jabatan/{jabatan}/edit', [JabatanController::class, 'edit'])->name('jabatan.edit');
        Route::put('/jabatan/{jabatan}', [JabatanController::class, 'update'])->name('jabatan.update');
        Route::delete('/jabatan/{jabatan}', [JabatanController::class, 'destroy'])->name('jabatan.destroy');

        // Routes for Pekerjaan
        Route::get('/pekerjaan', [PekerjaanController::class, 'index'])->name('pekerjaan.index');
        Route::get('/pekerjaan/create',[PekerjaanController::class, 'create'])->name('pekerjaan.create');
        Route::post('/pekerjaan/store',[PekerjaanController::class, 'store'])->name('pekerjaan.store');
        Route::get('/pekerjaan/{pekerjaan}/edit', [PekerjaanController::class, 'edit'])->name('pekerjaan.edit');
        Route::put('/pekerjaan/{pekerjaan}', [PekerjaanController::class, 'update'])->name('pekerjaan.update');
        Route::delete('/pekerjaan/{pekerjaan}', [PekerjaanController::class, 'destroy'])->name('pekerjaan.destroy');

        // Routes for Penilaian Karyawan
        Route::get('/penilaian-karyawan', [PenilaianController::class, 'index'])->name('penilaian.index');
        Route::get('/penilaian-karyawan/{user}/create', [PenilaianController::class, 'create'])->name('penilaian.create');
        Route::post('/penilaian-karyawan/{user}/store', [PenilaianController::class, 'store'])->name('penilaian.store');
        Route::get('/penilaian-karyawan/results', [PenilaianController::class, 'showResults'])->name('penilaian.show_results');
        Route::delete('/penilaian-karyawan/{user}', [PenilaianController::class, 'destroy'])->name('penilaian.destroy');
    });

    Route::prefix('admin/user')->middleware(['userAkses:user'])->group(function () {
        Route::get('/', [AdminController::class, 'user'])->name('dashboard.user'); // Dashboard untuk user biasa
    });
});
