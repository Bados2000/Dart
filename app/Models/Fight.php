<?php

// app/Models/Fight.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fight extends Model
{
    protected $table = 'fights'; // Nazwa tabeli w bazie danych

    protected $fillable = [
        'player1_id',
        'player2_id',
        'player1_legs',
        'player2_legs',
        'player1_points',
        'player2_points',
        'player1_darts',
        'player2_darts',
        // Inne pola, które mogą być potrzebne
    ];

    // Możesz dodać tutaj relacje, jeśli są potrzebne
}
