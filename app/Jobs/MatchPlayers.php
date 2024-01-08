<?php
// app/Jobs/MatchPlayers.php

namespace App\Jobs;

use App\Models\Queue;
use App\Models\Fight;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MatchPlayers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $players = Queue::orderBy('joined_at', 'asc')->get();

        foreach ($players as $player) {
            $opponent = Queue::where('id', '!=', $player->id)
                ->whereBetween('points', [$player->points - 50, $player->points + 50])
                ->orderBy('joined_at', 'asc')
                ->first();

            if ($opponent) {
                Fight::create([
                    'player1_id' => $player->user_id,
                    'player2_id' => $opponent->user_id
                ]);

                Queue::whereIn('id', [$player->id, $opponent->id])->delete();
            }
        }
    }
}
