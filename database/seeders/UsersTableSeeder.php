<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'firstname' => 'Michał',
            'lastname' => 'Badowski',
            'birthdate' => '1990-01-01',
            'email' => 'mimi2222@vp.pl',
            'username' => 'Bados2000',
            'password' => Hash::make('123456'),  // Użyj funkcji Hash do hasła
            'want_to_play' => false
        ]);

        User::create([
            'firstname' => 'Anna',
            'lastname' => 'Nowak',
            'birthdate' => '1992-02-02',
            'email' => 'anna.nowak@example.com',
            'username' => 'annanowak',
            'password' => Hash::make('123456'),
            'want_to_play' => false
        ]);

        User::create([
            'firstname' => 'Piotr',
            'lastname' => 'Wiśniewski',
            'birthdate' => '1988-03-03',
            'email' => 'piotr.wisniewski@example.com',
            'username' => 'piotrwisniewski',
            'password' => Hash::make('123456'),
            'want_to_play' => false
        ]);
    }
}
