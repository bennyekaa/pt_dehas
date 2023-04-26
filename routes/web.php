<?php

use App\Http\Controllers\BanjirController;
use App\Http\Controllers\BendunganController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DesaController;
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

Route::get('/', [HomeController::class, 'index']);

// map
route::get('/map', [MapController::class, 'index']);

//route CRUD USER
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/tambah', [UserController::class, 'tambah']);
Route::post('/user/store', [UserController::class, 'store']);
Route::get('/user/edit/{id}', [UserController::class, 'edit']);
Route::post('/proses', [UserController::class, 'proses']);
Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

//route CRUD DESA
Route::get('/desa', [DesaController::class, 'index']);
Route::get('/desa/tambah', [DesaController::class, 'tambah']);
Route::post('/desa/tambahproses', [DesaController::class, 'tambahproses']);
Route::get('/desa/edit/{id}', [DesaController::class, 'edit']);
Route::post('/prosesdesa', [DesaController::class, 'prosesdesa']);
Route::get('/desa/hapus/{id}', [DesaController::class, 'hapus']);

//route CRUD BENDUNGAN
Route::get('/bendungan', [BendunganController::class, 'index']);
Route::get('/bendungan/tambah', [BendunganController::class, 'tambah']);
Route::post('/bendungan/tambahproses', [BendunganController::class, 'tambahproses']);
Route::get('/bendungan/edit/{id}', [BendunganController::class, 'edit']);
Route::post('/prosesbendungan', [BendunganController::class, 'prosesbendungan']);
//Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

//View DATA DESA
Route::get('/banjir', [BanjirController::class, 'index']);

//form login
Route::get('/login', [HomeController::class, 'login']);

//EXPORT DESA
Route::get('/desa', [DesaController::class, 'index']);
Route::get('/desa/export_excel', [DesaController::class, 'export_excel']);
Route::post('/desa/import_excel', [DesaController::class, 'import_excel']);

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
