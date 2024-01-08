<?php
// app/Console/Commands/MatchPlayers.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Queue;
use App\Models\Fight;

class MatchPlayers extends Command
{
    protected $signature = 'match:players';
    protected $description = 'Match players from the queue';

    public function handle()
    {
        $players = Queue::orderBy('joined_at', 'asc')->get();

        foreach ($players as $player) {
            // Znajdź odpowiedniego przeciwnika
            $opponent = Queue::where('id', '!=', $player->id)
                ->whereBetween('points', [$player->points - 50, $player->points + 50])
                ->orderBy('joined_at', 'asc')
                ->first();

            if ($opponent) {
                // Utwórz nowy rekord walki
                Fight::create([
                    'player1_id' => $player->user_id,
                    'player2_id' => $opponent->user_id
                ]);

                // Usuń graczy z kolejki
                Queue::whereIn('id', [$player->id, $opponent->id])->delete();
            }
        }
    }
}
