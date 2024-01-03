<?php
// app/Http/Controllers/Auth/LoginController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Metoda do wyświetlania formularza logowania
    public function showLoginForm()
    {
        return view('auth.login'); // Upewnij się, że masz widok 'auth.login'
    }

    // Metoda do obsługi logowania
    public function login(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('username', 'password'))) {
            return redirect()->route('dart');
        }
        logger('Login failed');

        // Jeśli logowanie się nie powiedzie, wróć do formularza logowania z informacją o błędzie
        return back()->withErrors([
            'email' => 'Podane dane są nieprawidłowe.',
        ]);

    }

    // Metoda do wylogowania
    public function logout(): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        Auth::logout();
        return redirect()->route('dart');
    }
    public function redirectToLogin()
    {
        // Ustaw komunikat o błędzie
        session()->flash('error', 'Musisz się najpierw zalogować.');

        // Przekieruj do strony logowania
        return redirect()->route('login');
    }

}

