<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');



Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminController::class, 'loginAdmin'])->name('login');
        Route::post('/check', [AdminController::class, 'check'])->name('ckeck');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    });
    Route::middleware('auth:admin')->group(function () {
        Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    });
});
