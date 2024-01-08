<?php
// app/Models/Queue.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    protected $table = 'queue'; // Nazwa tabeli w bazie danych
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'joined_at',
        'points',
        // Inne pola, które mogą być potrzebne
    ];

    // Możesz dodać tutaj relacje, jeśli są potrzebne
}
