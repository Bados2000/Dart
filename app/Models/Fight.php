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
        // Inne pola, które mogą być potrzebne
    ];

    // Możesz dodać tutaj relacje, jeśli są potrzebne
}
