<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::group(['prefix'=>'auth'], function ($route) {
    Route::get('/register', [AuthController::class, 'viewregister']);
    Route::get('/login', [AuthController::class, 'viewlogin'])->name('login');
    Route::post('/postregister', [AuthController::class, 'register'])->name('post.register');
    Route::post('/postlogin', [AuthController::class, 'login'])->name('post.login');
});
