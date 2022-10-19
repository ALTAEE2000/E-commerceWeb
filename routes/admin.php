<?php

// use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LnaguagesController;
use App\Http\Controllers\HomeController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Auth::routes();
define('PAGINATION_COUNT', 10);





Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminController::class, 'loginAdmin'])->name('login');
        Route::post('/check', [AdminController::class, 'check'])->name('ckeck');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    });


    //----------------------- start begin lang route
    Route::group(['prefix' => 'languages'], function () {
        Route::get('/', [LnaguagesController::class, 'index'])->name('languages');
        Route::get('/create', [LnaguagesController::class, 'create'])->name('languages.create');
        Route::post('/store', [LnaguagesController::class, 'store'])->name('languages.store');

        Route::get('/edit/{id}', [LnaguagesController::class, 'edit'])->name('languages.edit');
        Route::put('/store', [LnaguagesController::class, 'update'])->name('languages.update');
    });
    //----------------------- end  lang route

});
