<?php

use App\Http\Controllers\Admin\ComplaintCategoryController;
use App\Http\Controllers\Admin\ComplaintController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\OutflowController;
use App\Http\Controllers\Admin\TrainController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WagonController;
use App\Http\Controllers\Admin\WaterLevelController;
use App\Http\Controllers\Admin\WaterWayController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OptimizationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

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

Route::get('/auth/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/auth/login', [LoginController::class, 'login'])->name('login.post');

Route::get('/auth/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/auth/register', [RegisterController::class, 'store'])->name('register.post');

Route::group(['middleware' => ['auth:web']], function(){

    //without resource
    Route::get('/train/{train}/wagon/{wagon}/outflow/chart', [OutflowController::class, 'chart'])->name('train.wagon.outflow.chart');
    Route::get('/train/{train}/wagon/{wagon}/water/chart', [WaterLevelController::class, 'chart'])->name('train.wagon.water.chart');

    //with resource
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/me', [ProfileController::class, 'edit'])->name('me.index');
    Route::resource('user', UserController::class);
    Route::resource('/train', TrainController::class);
    Route::resource('/complaint-category', ComplaintCategoryController::class);
    Route::resource('train.wagon', WagonController::class);
    Route::resource('train.wagon.ways', WaterWayController::class);
    Route::resource('train.wagon.outflow', OutflowController::class);
    Route::resource('train.wagon.water', WaterLevelController::class);
    Route::resource('complaint', ComplaintController::class);

    Route::get('/auth/logout', [LoginController::class, 'logout'])->name('logout.index');
});

Route::get('/optimize-cache', [OptimizationController::class, 'optimizeCache']);

