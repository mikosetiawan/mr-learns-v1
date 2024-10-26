<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManagementPelajaran\MapelController;
use App\Http\Controllers\ManagementPelajaran\NilaiController;
use App\Http\Controllers\ManagementSiswa\KelasController;
use App\Http\Controllers\ManagementSiswa\SemesterController;
use App\Http\Controllers\ManagementSiswa\SiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrasiController;
use App\Models\ManagementPelajaran\Mapel;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'welcome'])->name('welcome');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // SET SISWA ALL PROCCES
    Route::group(['prefix' => 'set-siswa', 'as' => 'set-siswa.'], function () {

        // SET SEMESTER
        Route::get('/semester', [SemesterController::class, 'index'])->name('semester.index');
        Route::post('/semester', [SemesterController::class, 'store'])->name('semester.store');
        Route::get('/semester/{id}/edit', [SemesterController::class, 'edit'])->name('semester.edit');
        Route::put('/semester/{id}', [SemesterController::class, 'update'])->name('semester.update');
        Route::delete('/semester/{id}', [SemesterController::class, 'destroy'])->name('semester.destroy');

        // SET KELAS
        Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
        Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store');
        Route::get('/kelas/{id}/edit', [KelasController::class, 'edit'])->name('kelas.edit');
        Route::put('/kelas/{id}', [KelasController::class, 'update'])->name('kelas.update');
        Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');

        // SET SISWA
        Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
        Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
        Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
        Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
        Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');

        // SET MAPEL
        Route::get('/mapel', [MapelController::class, 'index'])->name('mapel.index');
        Route::post('/mapel', [MapelController::class, 'store'])->name('mapel.store');
        Route::get('/mapel/{id}/edit', [MapelController::class, 'edit'])->name('mapel.edit');
        Route::put('/mapel/{id}', [MapelController::class, 'update'])->name('mapel.update');
        Route::delete('/mapel/{id}', [MapelController::class, 'destroy'])->name('mapel.destroy');

        // SET NILAI
        Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai.index');
        Route::post('/nilai', [NilaiController::class, 'store'])->name('nilai.store');
        Route::get('/nilai/{id}/edit', [NilaiController::class, 'edit'])->name('nilai.edit');
        Route::put('/nilai/{id}', [NilaiController::class, 'update'])->name('nilai.update');
        Route::delete('/nilai/{id}', [NilaiController::class, 'destroy'])->name('nilai.destroy');



         // SET NILAI
         Route::get('/user', [RegistrasiController::class, 'index'])->name('user.index');
         Route::post('/user', [RegistrasiController::class, 'store'])->name('user.store');
         Route::get('/user/{id}/edit', [RegistrasiController::class, 'edit'])->name('user.edit');
         Route::put('/user/{id}', [RegistrasiController::class, 'update'])->name('user.update');
         Route::delete('/user/{id}', [RegistrasiController::class, 'destroy'])->name('user.destroy');
    });
});

require __DIR__ . '/auth.php';
