<?php
// Przykładowy kontroler: app/Http/Controllers/GameController.php
namespace App\Http\Controllers;

use App\Models\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class GameController extends Controller
{
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
