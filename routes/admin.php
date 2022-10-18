<?php

// use App\Http\Controllers\Admin\LoginController;
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

Auth::routes();






// Route::get('admin/login',  [LoginController::class, 'getLogin'])->name('admin.login');
// Route::post('admin/postLogin',  [LoginController::class, 'postLogin'])->name('admin.post.login');



// Route::group(['namespace' => 'dashboard',  'middleware' => 'auth:admin'], function () {
//     Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('admin.dashboard');
// });
