<?php

use App\Http\Middleware\Authlogin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\MasyarakatController;

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
    return view('layout');
})->middleware('auth');

Route::get('/dashboard', function () {
    return view('layout')->middleware('auth');
});

Route::resource('masyarakat', PengaduanController::class)->middleware('Authlogin');

Route::get('/myinvoice', function () {
    return view('masyarakat.myinvoice');
})->middleware('Authlogin');

Route::group(['prefix'=>'auth'], function ($route) {
    Route::get('/register', [AuthController::class, 'viewregister']);
    Route::get('/login', [AuthController::class, 'viewlogin'])->name('login');
    Route::post('/postregister', [AuthController::class, 'register'])->name('post.register');
    Route::post('/postlogin', [AuthController::class, 'login'])->name('post.login');
});

Route::group(['prefix'=>'authmasyarakat'], function ($route) {
    Route::get('/register', [MasyarakatController::class, 'viewregister']);
    Route::get('/login', [MasyarakatController::class, 'viewlogin'])->name('loginmasyarakat');
    Route::post('/postregister', [MasyarakatController::class, 'register'])->name('post.registermasyarakat');
    Route::post('/postlogin', [MasyarakatController::class, 'login'])->name('post.loginmasyarakat');
});
