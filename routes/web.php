<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SppController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PetugasController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


// Route::group(['middleware', ['auth']], function(){
    // });
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');


// SPP
Route::get('/spps', [SppController::class, 'index'])->name('spps')->middleware('auth');
Route::get('/spp/create', [SppController::class, 'create'])->name('spp.create')->middleware('auth');
Route::post('/spp/create', [SppController::class, 'store'])->name('spp.store')->middleware('auth');
Route::get('/spp/{id}/edit', [SppController::class, 'edit'])->name('spp.edit')->middleware('auth');
Route::get('/spp/{id}/show', [SppController::class, 'show'])->name('spp.show')->middleware('auth');
Route::patch('/spp/{id}/update', [SppController::class, 'update'])->name('spp.update')->middleware('auth');
Route::delete('/spp/{id}/delete', [SppController::class, 'destroy'])->name('spp.destroy')->middleware('auth');

// PETUGAS
Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas')->middleware('auth');
Route::get('/petugas/create', [PetugasController::class, 'create'])->name('petugas.create')->middleware('auth');
Route::post('/petugas/create', [PetugasController::class, 'store'])->name('petugas.store')->middleware('auth');
Route::get('/petugas/{id}/edit', [PetugasController::class, 'edit'])->name('petugas.edit')->middleware('auth');
Route::get('/petugas/{id}/show', [PetugasController::class, 'show'])->name('petugas.show')->middleware('auth');
Route::patch('/petugas/{id}/update', [PetugasController::class, 'update'])->name('petugas.update')->middleware('auth');
Route::delete('/petugas/{id}/delete', [PetugasController::class, 'destroy'])->name('petugas.destroy')->middleware('auth');

// KELAS
Route::get('/kelas', [KelasController::class, 'index'])->name('kelas')->middleware('auth');
Route::get('/kela/create', [KelasController::class, 'create'])->name('kela.create')->middleware('auth');
Route::post('/kela/create', [KelasController::class, 'store'])->name('kela.store')->middleware('auth');
Route::get('/kela/{id}/edit', [KelasController::class, 'edit'])->name('kela.edit')->middleware('auth');
Route::get('/kela/{id}/show', [KelasController::class, 'show'])->name('kela.show')->middleware('auth');
Route::patch('/kela/{id}/update', [KelasController::class, 'update'])->name('kela.update')->middleware('auth');
Route::delete('/kela/{id}/delete', [KelasController::class, 'destroy'])->name('kela.destroy')->middleware('auth');

// SISWA
Route::get('/siswas', [SiswaController::class, 'index'])->name('siswas')->middleware('auth');
Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create')->middleware('auth');
Route::post('/siswa/create', [SiswaController::class, 'store'])->name('siswa.store')->middleware('auth');
Route::get('/siswa/{nisn}/edit', [SiswaController::class, 'edit'])->name('siswa.edit')->middleware('auth');
Route::get('/siswa/{nisn}/show', [SiswaController::class, 'show'])->name('siswa.show')->middleware('auth');
Route::patch('/siswa/{nisn}/update', [SiswaController::class, 'update'])->name('siswa.update')->middleware('auth');
Route::delete('/siswa/{nisn}/delete', [SiswaController::class, 'destroy'])->name('siswa.destroy')->middleware('auth');

// PEMBAYARAN
Route::get('/pembayarans', [PembayaranController::class, 'index'])->name('pembayarans')->middleware('auth');
Route::get('/pembayaran/create', [PembayaranController::class, 'create'])->name('pembayaran.create')->middleware('auth');
Route::get('/pembayaran/create2', [PembayaranController::class, 'create2'])->name('pembayaran.create2')->middleware('auth');
Route::post('/pembayaran/create', [PembayaranController::class, 'store'])->name('pembayaran.store')->middleware('auth');
Route::post('/pembayaran/create2', [PembayaranController::class, 'store2'])->name('pembayaran.store2')->middleware('auth');
Route::get('/pembayaran/{id}/edit', [PembayaranController::class, 'edit'])->name('pembayaran.edit')->middleware('auth');
Route::get('/pembayaran/{id}/show', [PembayaranController::class, 'show'])->name('pembayaran.show')->middleware('auth');
Route::patch('/pembayaran/{id}/update', [PembayaranController::class, 'update'])->name('pembayaran.update')->middleware('auth');
Route::delete('/pembayaran/{id}/delete', [PembayaranController::class, 'destroy'])->name('pembayaran.destroy')->middleware('auth');

// RIWAYAT PEMBAYARAN
Route::get('/pembayaran/riwayat', [PembayaranController::class, 'riwayat'])->name('pembayaran.riwayat');

// GET DATA SPP
Route::get('/pembayaran/dataSpp/{nisn}', [PembayaranController::class, 'getDataSpp']);

// EXPORT EXCEL
Route::get('/pembayaran/export/excel', [PembayaranController::class, 'export'])->name('pembayaran.export');


