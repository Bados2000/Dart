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
    public function getCurrentScore($fightId): \Illuminate\Http\JsonResponse
    {
        $fight = Fight::find($fightId);

        if (!$fight) {
            return response()->json(['error' => 'Walka nie znaleziona'], 404);
        }

        return response()->json([
            'player1_score' => $fight->player1_points,
            'player2_score' => $fight->player2_points,
            'player1_legs' => $fight->player1_legs, // Dodane
            'player2_legs' => $fight->player2_legs, // Dodane
            'player1_name' => User::find($fight->player1_id)->username,
            'player2_name' => User::find($fight->player2_id)->username,
            'logged_in_user_id' => Auth::id(), // Dodane

        ]);
    }
    // app/Http/Controllers/GameController.php
    public function updateScore(Request $request, $fightId): \Illuminate\Http\JsonResponse
    {
        // Pobranie wyniku przesłanego przez gracza
        $submittedScore = $request->input('score');

        // Pobranie walki na podstawie fightId
        $fight = Fight::find($fightId);

        if (!$fight) {
            return response()->json(['error' => 'Walka nie znaleziona'], 404);
        }

        // Pobranie zalogowanego użytkownika
        $user = Auth::user();

        if ($user->id == $fight->player1_id) {
            $fight->player1_points = max(0, $fight->player1_points - $submittedScore);
            if ($fight->player1_points == 0) {
                $fight->player1_legs += 1;
                if ($fight->player1_legs >= 3 || $fight->player2_legs >= 3) {
                    $this->finalizeGameAndUpdateRanking($fight);
                }
                $fight->player1_points = 501;
                // Możesz tutaj również resetować wyniki dla następnego lega, jeśli to konieczne
            }
        } elseif ($user->id == $fight->player2_id) {
            $fight->player2_points = max(0, $fight->player2_points - $submittedScore);
            if ($fight->player2_points == 0) {
                $fight->player2_legs += 1;
                if ($fight->player1_legs >= 3 || $fight->player2_legs >= 3) {
                    $this->finalizeGameAndUpdateRanking($fight);
                }
                $fight->player2_points = 501;
                // Analogicznie jak wyżej dla player2
            }
        } else {
            return response()->json(['error' => 'Nie jesteś uczestnikiem tej walki'], 403);
        }

        // Zapisanie zmian w bazie danych
        $fight->save();

        return response()->json(['message' => 'Wynik zaktualizowany']);
    }

    private function finalizeGameAndUpdateRanking($fight): void
    {
        // Określ zwycięzcę i przegranego
        $winnerId = $fight->player1_legs >= 3 ? $fight->player1_id : $fight->player2_id;
        $loserId = $fight->player1_legs >= 3 ? $fight->player2_id : $fight->player1_id;

        // Aktualizacja rankingu
        $this->updateRanking($winnerId, true); // Dodaj punkty zwycięzcy
        $this->updateRanking($loserId, false); // Odejmij punkty przegranego
        $winnerName = User::find($winnerId)->username;
        Log::info('Finalizacja gry dla walki ID: ' . $winnerName);

    }
    public function deleteFight($fightId):void
    {
        $fight = Fight::find($fightId);
        if ($fight) {
            Log::info('Usunięto walke: ' . $fightId);
            $fight->delete();
        }
        Log::info('Nie usunięto walki: ' . $fightId);

    }
    private function updateRanking($userId, $isWinner): void
    {
        $profile = User::find($userId)->profile;
        $change = $isWinner ? 5 : -5;
        $profile->ranking_points += $change;
        $profile->save();
    }
    public function getCurrentFightId(): \Illuminate\Http\JsonResponse
    {
        $user = Auth::user();

        $fight = Fight::where(function ($query) use ($user) {
            $query->where('player1_id', $user->id)
                ->orWhere('player2_id', $user->id);
        })->latest()->first();

        return response()->json(['fightId' => $fight ? $fight->id : null]);
    }


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
                $opponentSecondCameraIp = $opponent->settings->second_camera_ip; // Zakładając, że masz takie pole w ustawieniach użytkownika
                $opponentAutoScoring = $opponent->settings->auto_scoring; // Zakładając, że masz takie pole w ustawieniach użytkownika
                $opponentWebSocket = $opponent->settings->websocket_server_ip; // Zakładając, że masz takie pole w ustawieniach użytkownika
                $opponentUserName = $opponent->username;
                $opponentFirstCamera = $opponent->settings->camera;
                $opponentSecondCamera = $opponent->settings->second_camera;
                return view('ingame', [
                    'fight' => $fight,
                    'opponentCameraIp' => $opponentCameraIp,
                    'opponentUserName' => $opponentUserName,
                    'opponentSecondCameraIp' => $opponentSecondCameraIp,
                    'opponentAutoScoring' => $opponentAutoScoring,
                    'opponentWebSocket' => $opponentWebSocket,
                    'opponentFirstCamera' => $opponentFirstCamera,
                    'opponentSecondCamera' => $opponentSecondCamera,
                ]);
            }
        }

        // Możesz dodać tutaj obsługę sytuacji, gdy walka nie zostanie znaleziona
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
