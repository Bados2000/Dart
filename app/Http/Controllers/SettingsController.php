<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile;

        if ($request->hasFile('profilePicture') && $request->file('profilePicture')->isValid()) {
            // Usuń stare zdjęcie, jeśli istnieje
            if ($profile->profile_picture && Storage::disk('public')->exists($profile->profile_picture)) {
                Storage::disk('public')->delete($profile->profile_picture);
            }

            // Zapisz nowe zdjęcie
            $path = $request->file('profilePicture')->store('profile_pictures', 'public');
            $profile->profile_picture = $path;
            $profile->save();
        }

        return redirect()->back()->with('success', 'Profil zaktualizowany.');
    }
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $user = Auth::user();
        $settings = $user->settings; // Zmień na 'setting'

        return view('settings.index', ['setting' => $settings]);
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();
        $setting = $user->settings; // Zmień na 'setting'

        if ($setting) {
            // Aktualizacja istniejących ustawień
            $setting->update([
                'camera' => $request->cameraChoice,
                'camera_ip' => $request->cameraIP,
                'auto_scoring' => $request->has('autoScoring'),
                'websocket_server_ip' => $request->serverIP,
            ]);
        } else {
            // Logika, jeśli ustawienia nie istnieją (możesz też tu utworzyć nowe ustawienia)
        }

        return redirect()->back()->with('success', 'Ustawienia zostały zaktualizowane.');
    }
}
