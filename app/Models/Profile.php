<?php
// app/Models/Profile.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    use HasFactory;

    protected static function booted()
    {
        static::created(function ($profile) {
            // Tworzenie rekordu w tabeli rankings
            $ranking = Ranking::create([
                'profile_id' => $profile->id,
                // Inne domyślne wartości
            ]);

            // Aktualizacja rankingu
            static::updateRanking();
        });

        static::updated(function ($profile) {
            // Aktualizacja rankingu, jeśli zmienią się punkty
            if ($profile->isDirty('ranking_points')) {
                static::updateRanking();
            }
        });
    }

    protected static function updateRanking()
    {
        $profiles = Profile::orderBy('ranking_points', 'desc')->get();
        foreach ($profiles as $index => $profile) {
            Ranking::updateOrCreate(
                ['profile_id' => $profile->id],
                ['position' => $index + 1]
            );
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacja z rankingiem
    public function ranking()
    {
        return $this->hasOne(Ranking::class);
    }
}

