<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    use HasFactory;

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
    // Definiuj pola, które mogą być masowo przypisywane
    protected $fillable = [
        'profile_id',
        'position',
        'total_points',
    ];

}
