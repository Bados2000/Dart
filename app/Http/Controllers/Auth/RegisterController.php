<?php

// app/Http/Controllers/RegisterController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Profile;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register'); // załóżmy, że widok nazywa się 'auth.register'
    }
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'firstname' => $validatedData['firstname'],
            'lastname' => $validatedData['lastname'],
            'birthdate' => $validatedData['birthdate'],
            'email' => $validatedData['email'],
            'username' => $validatedData['username'],
            'password' => Hash::make($validatedData['password']),
        ]);
        // Tworzenie profilu użytkownika
        $profile = new Profile();
        $profile->user_id = $user->id;
        // tutaj możesz ustawić domyślne wartości dla profilu
        $profile->save();
        // Tworzenie profilu użytkownika
        $settings = new Settings();
        $settings->user_id = $user->id;
        // tutaj możesz ustawić domyślne wartości dla profilu
        $settings->save();


        // Automatyczne logowanie użytkownika po rejestracji
        Auth::login($user);

        // Przekierowanie użytkownika na stronę główną lub inną stronę
        return redirect()->route('dart');
    }
}
