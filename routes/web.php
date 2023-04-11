<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DesaController;

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


//form login
Route::get('/login', [HomeController::class, 'login']);


//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
