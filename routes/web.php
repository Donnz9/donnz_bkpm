<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PengalamanKerjaController;
use App\Http\Controllers\Backend\PendidikanController;
use App\Http\Controllers\CobaController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Auth;

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

Route::resource('/home', HomeController::class);    //acara7
Route::resource('/dashboard', DashboardController::class);  //acara8

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/pengalaman_kerja', PengalamanKerjaController::class);
Route::resource('/pendidikan', PendidikanController::class);

Route::get('/session/create', [SessionController::class, 'create']);
Route::get('/session/show', [SessionController::class, 'show']);
Route::get('/session/delete', [SessionController::class, 'delete']);
Route::get('/pegawai/{nama}', [PegawaiController::class, 'index']);
Route::get('/formulir', [PegawaiController::class, 'formulir']);
Route::post('/formulir/proses', [PegawaiController::class, 'proses']);
Route::get('/cobaerror', [CobaController::class, 'index']);
Route::get('/cobaerror/{nama}', [CobaController::class, 'index']);

Route::get('/upload', [UploadController::class, 'upload'])->name('upload');
Route::post('/upload/proses', [UploadController::class, 'proses_upload'])->name('upload.proses');
Route::post('/upload/resize', [UploadController::class, 'resize_upload'])->name('upload.resize');