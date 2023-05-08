<?php

use App\Http\Controllers\BanjirController;
use App\Http\Controllers\BendunganController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PengungsianController;
use App\Http\Controllers\TitikKumpulController;
use App\Http\Controllers\WebController;
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

Route::get('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/actionlogin', [LoginController::class, 'actionlogin']);

Route::middleware('checklogin')->group(function () {
    Route::get('/', [HomeController::class, 'index']);

    // map
    route::get('/map', [MapController::class, 'index']);

    // import menu
    route::get('/import', [ImportController::class, 'import']);

    // detail Bendungan
    route::get('/detailbendungan', [BendunganController::class, 'detailbendungan']);

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

    //route CRUD Titik Kumpul
    Route::get('/titikkumpul', [TitikKumpulController::class, 'index']);
    // Route::get('/desa/tambah', [TitikKumpulController::class, 'tambah']);
    // Route::post('/desa/tambahproses', [TitikKumpulController::class, 'tambahproses']);
    // Route::get('/desa/edit/{id}', [TitikKumpulController::class, 'edit']);
    // Route::post('/prosesdesa', [TitikKumpulController::class, 'prosestitikkumpul']);
    // Route::get('/desa/hapus/{id}', [TitikKumpulController::class, 'hapus']);

    //route CRUD Pengungsian
    Route::get('/pengungsian', [PengungsianController::class, 'index']);
   // Route::get('/desa/tambah', [TitikKumpulController::class, 'tambah']);
   // Route::post('/desa/tambahproses', [TitikKumpulController::class, 'tambahproses']);
   // Route::get('/desa/edit/{id}', [TitikKumpulController::class, 'edit']);
   // Route::post('/prosesdesa', [TitikKumpulController::class, 'prosestitikkumpul']);
   // Route::get('/desa/hapus/{id}', [TitikKumpulController::class, 'hapus']);

    //route CRUD BENDUNGAN
    Route::get('/bendungan', [BendunganController::class, 'index']);
    Route::get('/bendungan/tambah', [BendunganController::class, 'tambah']);
    Route::post('/bendungan/tambahproses', [BendunganController::class, 'tambahproses']);
    Route::get('/bendungan/edit/{id}', [BendunganController::class, 'edit']);
    Route::post('/prosesbendungan', [BendunganController::class, 'prosesbendungan']);
    //Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

    Route::get('web', [WebController::class, 'index']);
    Route::get('/web/tambah', [WebController::class, 'tambah']);
    Route::get('/web/edit/{id}', [WebController::class, 'edit']);
    Route::post('web/proses', [WebController::class, 'proses']);
    Route::get('web/hapus/{id}', [WebController::class, 'hapus']);

    //View DATA DESA
    Route::get('/banjir', [BanjirController::class, 'index']);


    //EXPORT DESA
    Route::get('/desa', [DesaController::class, 'index']);
    Route::get('/desa/export_excel', [DesaController::class, 'export_excel']);
    Route::post('/desa/import_excel', [DesaController::class, 'import_excel']);

    //Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
