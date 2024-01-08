<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\GameController;

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

Route::middleware('auth')->group(function () {
    // Zdefiniuj trasy, które wymagają zalogowanego użytkownika

    Route::get('/game', function () {
        return view('game');
    })->name('game');

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    Route::get('/stats', function () {
        return view('stats');
    })->name('stats');



    Route::get('/api/check-match', [GameController::class, 'checkMatch']);
    Route::get('/api/get-opponent/{id}', [GameController::class, 'getOpponent']);
    Route::post('/join-queue', [GameController::class, 'joinQueue'])->name('join-queue');
    Route::get('/ingame', [GameController::class, 'showGameView'])->name('ingame');

// Trasa do wyświetlania formularza
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');

// Trasa do zapisu danych formularza
    Route::post('/settings', [SettingsController::class, 'store'])->name('settings.store');

    Route::post('/profile/update', [SettingsController::class, 'update'])->name('settings.update');


});

Route::get('/', function () {
    return view('dart');
})->name('dart');

Auth::routes();

Route::get('/redirectToLogin', [\App\Http\Controllers\Auth\LoginController::class, 'redirectToLogin'])->name('redirectToLogin');
