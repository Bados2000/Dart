<?php
// Przykładowy kontroler: app/Http/Controllers/GameController.php
namespace App\Http\Controllers;

use App\Models\Fight;
use App\Models\Queue;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class GameController extends Controller
{
    public function showGameView()
    {
        $user = Auth::user();
        $fight = Fight::where('player1_id', $user->id)
            ->orWhere('player2_id', $user->id)
            ->first();

        if ($fight) {
            $opponentId = $user->id == $fight->player1_id ? $fight->player2_id : $fight->player1_id;
            $opponent = User::find($opponentId);

            if ($opponent) {
                $opponentCameraIp = $opponent->settings->camera_ip; // Zakładając, że masz takie pole w ustawieniach użytkownika

                return view('ingame', [
                    'opponentCameraIp' => $opponentCameraIp
                ]);
            }
        }


    }
    public function checkMatch(): \Illuminate\Http\JsonResponse
    {
        try {
            $user = Auth::user();

            // Logika sprawdzająca, czy użytkownik ma przeciwnika
            $fight = Fight::where('player1_id', $user->id)
                ->orWhere('player2_id', $user->id)
                ->first();

            if ($fight) {
                // Użytkownik ma przeciwnika
                return response()->json([
                    'status' => 'matched',
                    'opponent_id' => $user->id == $fight->player1_id ? $fight->player2_id : $fight->player1_id,
                    // Możesz dodać więcej informacji o przeciwniku jeśli potrzebujesz
                ]);
            } else {
                // Użytkownik nie ma jeszcze przeciwnika
                return response()->json(['status' => 'waiting']);
            }
        } catch (\Exception $e) {
            // Logowanie wyjątku
            Log::error("Błąd w checkMatch: " . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
    public function getOpponent($id): \Illuminate\Http\JsonResponse
    {
        try {

            $opponent = User::with('profile')->find($id);

            if (!$opponent) {
                return response()->json(['message' => 'Opponent not found'], 404);
            }

            return response()->json([
                'username' => $opponent->username,
                'profile_picture' => asset('storage/' . $opponent->profile->profile_picture),
            ]);
        } catch (\Exception $e) {
            Log::error("Błąd w getOpponent: " . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
    public function joinQueue(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $user = Auth::user();
            if (!$user) {
                Log::warning('Próba dołączenia do kolejki przez niezalogowanego użytkownika.');
                return response()->json(['message' => 'User not authenticated'], 401);
            }

            $alreadyInQueue = Queue::where('user_id', $user->id)->exists();
            if ($alreadyInQueue) {
                return response()->json(['message' => 'You are already in the queue!'], 400);
            }

            $points = $user->profile->ranking_points;

            Queue::create([
                'user_id' => $user->id,
                'joined_at' => Carbon::now(),
                'points' => $points,
            ]);

            return response()->json(['message' => 'You have joined the queue!']);
        } catch (\Exception $e) {
            Log::error('Błąd przy dołączaniu do kolejki: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error xd'], 500);
        }
    }

}
