<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Game\GameController;
use App\Http\Controllers\Test\TestLoginController;

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

Route::get('/', function () {return view('Login');})->name('home');
Route::get('/login', function () {return view('Login');})->name('login');
Route::get('/register', function () {return view('Register');});

Route::get('/game/{any}', [GameController::class, 'index'])->where('any', '.*');

Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/test-login', [TestLoginController::class, 'testLogin'])->name('test.login');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//Auth::routes();