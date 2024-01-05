<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

Route::post('/register', [RegisterController::class, 'register'])->name('register');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dart');
})->name('dart');

Route::get('/game', function () {
    return view('game');
})->name('game');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Auth::routes();

Route::get('/redirectToLogin', [\App\Http\Controllers\Auth\LoginController::class, 'redirectToLogin'])->name('redirectToLogin');
