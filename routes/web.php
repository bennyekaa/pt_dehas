<?php

use App\Http\Controllers\BanjirController;
use App\Http\Controllers\BendunganController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WadukController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\KategoriBocorController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Pengaturan;
use App\Http\Controllers\PengungsianController;
use App\Http\Controllers\StatusBocorController;
use App\Http\Controllers\TitikKumpulController;
use App\Http\Controllers\TransBanjir;
use App\Http\Controllers\TransBocor;
use App\Http\Controllers\WebController;
use App\Http\Controllers\JabatanController;
use App\Models\jabatan;
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

    //route CRUD Jabatan
    Route::get('/jabatan', [JabatanController::class, 'index']);
    Route::get('/jabatan/tambah', [JabatanController::class, 'tambah']);
    Route::post('/jabatan/tambahproses', [JabatanController::class, 'tambahproses']);
    Route::get('/jabatan/edit/{id}', [JabatanController::class, 'edit']);
    Route::post('/jabatan/proses', [JabatanController::class, 'proses']);
    Route::get('/jabatan/hapus/{id}', [JabatanController::class, 'hapus']);

    //route CRUD waduk
    // Route::get('/waduk', [WadukController::class, 'index']);
    Route::get('/waduk/tambah', [WadukController::class, 'tambah']);
    Route::get('/waduk/import', [WadukController::class, 'import']);
    Route::get('/waduk/export', [WadukController::class, 'export']);
    Route::post('/waduk/proses/excel', [WadukController::class, 'proses_excel']);
    Route::post('/waduk/proses', [WadukController::class, 'proses']);
    Route::post('/waduk/store', [WadukController::class, 'store']);
    Route::get('/waduk/edit/{id}', [WadukController::class, 'edit']);
    Route::post('/tambahproses', [WadukController::class, 'tambahproses']);
    Route::get('/waduk/hapus/{id}', [WadukController::class, 'hapus']);

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
    Route::get('/titikkumpul/hapus/{id}', [TitikKumpulController::class, 'hapus']);

    //route CRUD waduk
    Route::get('/waduk', [WadukController::class, 'index']);
    // Route::get('/desa/tambah', [TitikKumpulController::class, 'tambah']);
    // Route::post('/desa/tambahproses', [TitikKumpulController::class, 'tambahproses']);
    // Route::get('/desa/edit/{id}', [TitikKumpulController::class, 'edit']);
    // Route::post('/prosesdesa', [TitikKumpulController::class, 'prosestitikkumpul']);
    // Route::get('/desa/hapus/{id}', [TitikKumpulController::class, 'hapus']);

    //route CRUD Pengungsian
    Route::get('/pengungsian', [PengungsianController::class, 'index']);
   // Route::get('/desa/tambah', [PengungsianController::class, 'tambah']);
   // Route::post('/desa/tambahproses', [PengungsianController::class, 'tambahproses']);
   // Route::get('/desa/edit/{id}', [PengungsianController::class, 'edit']);
   // Route::post('/prosesdesa', [PengungsianController::class, 'prosestitikkumpul']);
    Route::get('/pengungsian/hapus/{id}', [PengungsianController::class, 'hapus']);

    //route CRUD BENDUNGAN
    Route::get('/bendungan', [BendunganController::class, 'index']);
    Route::get('/bendungan/tambah', [BendunganController::class, 'tambah']);
    Route::post('/bendungan/tambahproses', [BendunganController::class, 'tambahproses']);
    Route::get('/bendungan/edit/{id}', [BendunganController::class, 'edit']);
    Route::post('/prosesbendungan', [BendunganController::class, 'prosesbendungan']);
    Route::get('/bendungan/hapus/{id}', [BendunganController::class, 'hapus']);

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

    Route::get('/kategoribocor', [KategoriBocorController::class, 'index']);
    Route::get('/kategoribocor/tambah', [KategoriBocorController::class, 'tambah']);
    Route::get('/kategoribocor/edit/{id}', [KategoriBocorController::class, 'edit']);
    Route::post('/kategoribocor/proses', [KategoriBocorController::class, 'proses']);
    Route::get('/kategoribocor/hapus/{id}', [KategoriBocorController::class, 'hapus']);

    Route::get('/statusbocor', [StatusBocorController::class, 'index']);
    Route::get('/statusbocor/tambah', [StatusBocorController::class, 'tambah']);
    Route::get('/statusbocor/edit/{id}', [StatusBocorController::class, 'edit']);
    Route::post('/statusbocor/proses', [StatusBocorController::class, 'proses']);
    Route::get('/statusbocor/hapus/{id}', [StatusBocorController::class, 'hapus']);

    Route::get('/pengaturan/qr', [Pengaturan::class, 'qr']);

    Route::get('/device', [DeviceController::class, 'index']);
    Route::post('/device/proses', [DeviceController::class, 'proses']);
    Route::get('/device/lihat/{id}', [DeviceController::class, 'lihat']);
    Route::get('/device/edit/{id}', [DeviceController::class, 'edit']);
    Route::get('/device/reset/{id}', [DeviceController::class, 'reset']);
    Route::get('/device/status/{id}/{id2}', [DeviceController::class, 'status']);
    Route::get('/device/hapus/{id}', [DeviceController::class, 'hapus']);

    //Auth::routes();

    Route::prefix('transaksi')->group(function(){
        Route::prefix('mukaair')->group(function(){
            Route::get('index/{id}', [TransBanjir::class, 'index']);
            Route::get('tambah', [TransBanjir::class, 'tambah']);
            Route::post('proses', [TransBanjir::class, 'proses']);
            Route::get('kirim/{id}', [TransBanjir::class, 'kirim']);
            Route::get('pesan/{id}/{id2}', [TransBanjir::class, 'pesan']);
            Route::post('notif', [TransBanjir::class, 'notif']);
            Route::get('hapus/{id}', [TransBanjir::class, 'hapus']);
        });
        Route::prefix('bocor')->group(function(){
            Route::get('index/{id}', [TransBocor::class, 'index']);
            Route::get('get_status/{id}', [TransBocor::class, 'get_status']);
            Route::get('tambah', [TransBocor::class, 'tambah']);
            Route::post('proses', [TransBocor::class, 'proses']);
            Route::get('kirim/{id}', [TransBocor::class, 'kirim']);
            Route::get('hapus/{id}', [TransBocor::class, 'hapus']);
            Route::get('pesan/{id}/{id2}', [TransBocor::class, 'pesan']);
            Route::post('notif', [TransBocor::class, 'notif']);
            Route::get('view_berkas/{id}', [TransBocor::class, 'lihat_berkas']);
        });

    });



    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
