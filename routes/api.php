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

Route::get('/notif', [ApiController::class, 'notif']);
Route::get('/master_web', [ApiController::class, 'master_web']);
Route::get('/master_desa', [ApiController::class, 'master_desa']);
Route::get('/master_pengungsian', [ApiController::class, 'master_p']);
Route::get('/master_titikkumpul', [ApiController::class, 'master_tk']);
Route::get('/master_bendungan', [ApiController::class, 'master_bendungan']);
Route::get('/master_user', [ApiController::class, 'master_user']);
Route::get('/login', [ApiController::class, 'login']);
Route::get('/register', [ApiController::class, 'register']);
Route::put('/update/{id}', [ApiController::class, 'update_notif']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
