<?php

use App\Http\Controllers\Admin\ComplaintController;
use App\Http\Controllers\Api\ComplaintCategoryController;
use App\Http\Controllers\Api\HistoryController;
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

Route::post('/outflow', [HistoryController::class, 'outflow']);
Route::get('/complaint-category', [ComplaintCategoryController::class, 'index']);
Route::post('/complaint', [ComplaintController::class, 'store']);
