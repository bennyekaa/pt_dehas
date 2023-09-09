<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/master_web', [ApiController::class, 'master_web']);
Route::get('/master_desa/{id?}', [ApiController::class, 'master_desa']);
Route::get('/master_pengungsian/{id?}', [ApiController::class, 'master_p']);
Route::get('/master_titikkumpul/{id?}', [ApiController::class, 'master_tk']);
Route::get('/master_bendungan/{id?}', [ApiController::class, 'master_bendungan']);
Route::get('/master_user/{id?}', [ApiController::class, 'master_user']);
Route::get('/master_role/{id?}', [ApiController::class, 'master_role']);
Route::get('/notif', [ApiController::class, 'notif']);
Route::get('/login/{id}/{id1}', [ApiController::class, 'login']);
Route::post('/register/penduduk', [ApiController::class, 'register']);
Route::post('/update', [ApiController::class, 'update_notif']);
Route::get('/exist/{id?}', [ApiController::class, 'check_user']);
Route::get('/checkdevice/{id}', [ApiController::class, 'check_device']);
Route::get('/device/{id?}', [ApiController::class, 'device_ready']);
Route::post('/add/device', [ApiController::class, 'add_device']);
Route::get('/peta_aktif', [ApiController::class, 'peta_aktif']);
Route::get('/list_peta', [ApiController::class, 'list_peta']);
Route::get('/desa_filter', [ApiController::class, 'desa_filter']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
