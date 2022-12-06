<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\ApotekerController;
use App\Http\Controllers\Rm_ObatController;
use App\Http\Controllers\Rekam_MedisController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

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
Route::get('/pasien/add', [PasienController::class, 'create'])->name('pasien.create');
Route::post('/pasien/store', [PasienController::class, 'store'])->name('pasien.store');
Route::get('/pasien', [PasienController::class, 'index'])->name('pasien.index')->middleware('auth');
Route::get('/pasien/edit/{id}', [PasienController::class, 'edit'])->name('pasien.edit');
Route::post('/pasien/update/{id}', [PasienController::class, 'update'])->name('pasien.update');
Route::post('/pasien/delete/{id}', [PasienController::class, 'delete'])->name('pasien.delete');
Route::get('/pasien/search', [PasienController::class, 'search'])->name('pasien.search');
Route::get('/pasien/hide/{id}', [PasienController::class, 'hide'])->name('pasien.hide');
Route::get('/pasien/trash', [PasienController::class, 'trash'])->name('pasien.trash');
Route::get('/pasien/restore/{id}', [PasienController::class, 'restore'])->name('pasien.restore');
Route::get('/pasien/search/trash', [PasienController::class, 'search_trash'])->name('pasien.search_trash');

Route::get('/dokter/add', [DokterController::class, 'create'])->name('dokter.create');
Route::post('/dokter/store', [DokterController::class, 'store'])->name('dokter.store');
Route::get('/dokter', [DokterController::class, 'index'])->name('dokter.index')->middleware('auth');
Route::get('/dokter/edit/{id}', [DokterController::class, 'edit'])->name('dokter.edit');
Route::post('/dokter/update/{id}', [DokterController::class, 'update'])->name('dokter.update');
Route::post('/dokter/delete/{id}', [DokterController::class, 'delete'])->name('dokter.delete');
Route::get('/dokter/search', [DokterController::class, 'search'])->name('dokter.search');
Route::get('/dokter/hide/{id}', [DokterController::class, 'hide'])->name('dokter.hide');
Route::get('/dokter/trash', [DokterController::class, 'trash'])->name('dokter.trash');
Route::get('/dokter/restore/{id}', [DokterController::class, 'restore'])->name('dokter.restore');
Route::get('/dokter/search/trash', [DokterController::class, 'search_trash'])->name('dokter.search_trash');


Route::get('/apoteker/add', [ApotekerController::class, 'create'])->name('apoteker.create');
Route::post('/apoteker/store', [ApotekerController::class, 'store'])->name('apoteker.store');
Route::get('/apoteker', [ApotekerController::class, 'index'])->name('apoteker.index')->middleware('auth');
Route::get('/apoteker/edit/{id}', [ApotekerController::class, 'edit'])->name('apoteker.edit');
Route::post('/apoteker/update/{id}', [ApotekerController::class, 'update'])->name('apoteker.update');
Route::post('/apoteker/delete/{id}', [ApotekerController::class, 'delete'])->name('apoteker.delete');
Route::get('/apoteker/search', [ApotekerController::class, 'search'])->name('apoteker.search');
Route::get('/apoteker/hide/{id}', [ApotekerController::class, 'hide'])->name('apoteker.hide');
Route::get('/apoteker/trash', [ApotekerController::class, 'trash'])->name('apoteker.trash');
Route::get('/apoteker/restore/{id}', [ApotekerController::class, 'restore'])->name('apoteker.restore');
Route::get('/apoteker/search/trash', [ApotekerController::class, 'search_trash'])->name('apoteker.search_trash');

Route::get('/rm_obat/add', [Rm_ObatController::class, 'create'])->name('rm_obat.create');
Route::post('/rm_obat/store', [Rm_ObatController::class, 'store'])->name('rm_obat.store');
Route::get('/rm_obat', [Rm_ObatController::class, 'index'])->name('rm_obat.index')->middleware('auth');
Route::get('/rm_obat/edit/{id}', [Rm_ObatController::class, 'edit'])->name('rm_obat.edit');
Route::post('/rm_obat/update/{id}', [Rm_ObatController::class, 'update'])->name('rm_obat.update');
Route::post('/rm_obat/delete/{id}', [Rm_ObatController::class, 'delete'])->name('rm_obat.delete');
Route::get('/rm_obat/search', [Rm_ObatController::class, 'search'])->name('rm_obat.search');
Route::get('/rm_obat/hide/{id}', [Rm_ObatController::class, 'hide'])->name('rm_obat.hide');
Route::get('/rm_obat/trash', [Rm_ObatController::class, 'trash'])->name('rm_obat.trash');
Route::get('/rm_obat/restore/{id}', [Rm_ObatController::class, 'restore'])->name('rm_obat.restore');
Route::get('/rm_obat/search/trash', [Rm_ObatController::class, 'search_trash'])->name('rm_obat.search_trash');

Route::get('/rekam_medis/add', [Rekam_MedisController::class, 'create'])->name('rekam_medis.create');
Route::post('/rekam_medis/store', [Rekam_MedisController::class, 'store'])->name('rekam_medis.store');
Route::get('/rekam_medis', [Rekam_MedisController::class, 'index'])->name('rekam_medis.index')->middleware('auth');
Route::get('/rekam_medis/edit/{id}', [Rekam_MedisController::class, 'edit'])->name('rekam_medis.edit');
Route::post('/rekam_medis/update/{id}', [Rekam_MedisController::class, 'update'])->name('rekam_medis.update');
Route::post('/rekam_medis/delete/{id}', [Rekam_MedisController::class, 'delete'])->name('rekam_medis.delete');
Route::get('/rekam_medis/search', [Rekam_MedisController::class, 'search'])->name('rekam_medis.search');
Route::get('/rekam_medis/hide/{id}', [Rekam_MedisController::class, 'hide'])->name('rekam_medis.hide');
Route::get('/rekam_medis/trash', [Rekam_MedisController::class, 'trash'])->name('rekam_medis.trash');
Route::get('/rekam_medis/restore/{id}', [Rekam_MedisController::class, 'restore'])->name('rekam_medis.restore');
Route::get('/rekam_medis/search/trash', [Rekam_MedisController::class, 'search_trash'])->name('rekam_medis.search_trash');

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/login', [LoginController::class, 'index'])->name('login.index')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);


Route::get('/register', [RegisterController::class, 'index'])->name('register.index')->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');


