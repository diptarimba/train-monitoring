<?php

use App\Http\Controllers\Api\ComplaintController;
use App\Http\Controllers\Api\ComplaintCategoryController;
use App\Http\Controllers\Api\HistoryController;
use App\Http\Controllers\Api\TrainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/water/outflow', [HistoryController::class, 'water_outflow']);
Route::post('/water/level', [HistoryController::class, 'water_level']);
Route::get('/complaint-category', [ComplaintCategoryController::class, 'index']);
Route::get('/train', [TrainController::class, 'index']);
Route::get('/train/{train}/wagon', [TrainController::class, 'wagon']);
Route::get('/complaint', [ComplaintController::class, 'index']);
Route::post('/complaint', [ComplaintController::class, 'store']);
Route::post('/complaint/{complaint}/status', [ComplaintController::class, 'updateStatus']);
