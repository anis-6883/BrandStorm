<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Frontend\UserController;
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

Route::get('/user/login', [UserController::class, 'login'])->name('user.login');
Route::post('/user/authenticate', [UserController::class, 'login'])->name('user.authenticate');
Route::get('/user/register', [UserController::class, 'register'])->name('user.register');
Route::post('/user/register', [UserController::class, 'register'])->name('user.register');

// Admin Login Route
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::post('/admin/auth', [AdminController::class, 'index'])->name('admin.auth');

Route::group(['middleware' => 'admin_auth'], function()
{
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('/admin/category', CategoryController::class);

});


