<?php

use App\Http\Controllers\Admin\ComplaintController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\TrainController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WagonController;
use App\Http\Controllers\Admin\WaterHistoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Models\Complaint;
use App\Models\WaterHistory;
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

    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/me', [ProfileController::class, 'edit'])->name('me.index');
    Route::resource('user', UserController::class);
    Route::resource('/train', TrainController::class);
    Route::resource('train.wagon', WagonController::class);
    Route::resource('train.water', WaterHistoryController::class);
    Route::resource('complaint', ComplaintController::class);

    Route::get('/auth/logout', [LoginController::class, 'logout'])->name('logout.index');
});


