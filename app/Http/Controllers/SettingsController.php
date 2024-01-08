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
        $setting = $user->settings;

        // Aktualizacja zdjęcia profilowego
        if ($request->hasFile('profilePicture') && $request->file('profilePicture')->isValid()) {
            // Usuń stare zdjęcie, tylko jeśli nie jest to zdjęcie domyślne
            if ($profile->profile_picture && !str_contains($profile->profile_picture, 'default-profile.jpg')) {
                Storage::disk('public')->delete($profile->profile_picture);
            }

            // Zapisz nowe zdjęcie
            $path = $request->file('profilePicture')->store('profile_pictures', 'public');
            $profile->profile_picture = $path;
            $profile->save();
        }

        // Aktualizacja ustawień
        if ($setting) {
            $setting->update([
                'camera' => $request->cameraChoice,
                'camera_ip' => $request->cameraIP,
                'second_camera' => $request->secondCameraChoice,
                'second_camera_ip' => $request->secondCameraIP,
                'auto_scoring' => $request->has('autoScoring'),
                'websocket_server_ip' => $request->serverIP,
            ]);
        } else {
            // Logika, jeśli ustawienia nie istnieją (możesz tu utworzyć nowe ustawienia)
        }

        // Przekierowanie z powrotem z wiadomością o sukcesie
        return redirect()->back()->with('success', 'Profil i ustawienia zostały zaktualizowane.');
    }

    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $user = Auth::user();
        $settings = $user->settings; // Zmień na 'setting'

        return view('settings.index', ['setting' => $settings]);
    }


}
