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
Route::get('/log_device/{id}', [ApiController::class, 'log_ready']);
Route::get('/device/{id?}', [ApiController::class, 'device_ready']);
Route::get('/check', [ApiController::class, 'mac_check']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
