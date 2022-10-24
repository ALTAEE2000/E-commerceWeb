<?php

// use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LnaguagesController;
use App\Http\Controllers\Admin\MainCateController;
use App\Http\Controllers\HomeController;
use App\Models\MainCategories;
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
        Route::put('/update/{id}', [LnaguagesController::class, 'update'])->name('languages.update');
        Route::delete('/delete/{id}', [LnaguagesController::class, 'delete'])->name('languages.delete');
    });
    //----------------------- end  lang route

    //----------------------- start begin mainCate route
    Route::group(['prefix' => 'main_categories'], function () {
        Route::get('/', [MainCateController::class, 'index'])->name('mainCategories');
        Route::get('/create', [MainCateController::class, 'create'])->name('categories.create');
        Route::post('/store', [MainCateController::class, 'store'])->name('categories.store');

        Route::get('/edit/{mainCategory}', [MainCateController::class, 'edit'])->name('categories.edit');
        Route::post('/update/{mainCategory_id}', [MainCateController::class, 'update'])->name('categories.update');
        Route::delete('/delete/{id}', [MainCateController::class, 'delete'])->name('categories.delete');
    });
    //----------------------- end mainLang

});



ROute::get('test-helper', function () {
    return showName();
});
