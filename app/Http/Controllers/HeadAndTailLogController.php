<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\HeadAndTailLog;
use Illuminate\Support\Facades\Log;

class HeadAndTailLogController extends Controller
{
    public function HeadAndTailLogResult(Request $request)
    {
        try {
            $GameLog = HeadAndTailLog::find($request->GameLogId);

            if (!$GameLog) {
                return response()->json([
                    'success' => false,
                    'message' => 'Game log not found.'
                ], 404);
            }

            // Return a JSON response
            return response()->json([
                'success' => true,
                'data' => $GameLog
            ]);
        } catch (\Throwable $th) {
            Log::error($th);

            // Return a JSON error response
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching game log details.'
            ], 500);
        }
    }

    // Only used on the server to use the cron job
    public function autoGameLogs()
    {
        // Fetch the old game log and update its status
        $gameLog = HeadAndTailLog::latest()->first();
        if ($gameLog) {
            $gameLog->status = 'stopped';
            $gameLog->update();
        }

        // Generate custom log_id
        $datePrefix = now()->format('Ymd'); // Format: YYYYMMDD
        $lastLog = HeadAndTailLog::where('log_id', 'like', $datePrefix . '%')
            ->orderBy('log_id', 'desc')
            ->first();

        $nextNumber = 1;

        if ($lastLog) {
            $lastNumber = (int)substr($lastLog->log_id, -5); // Extract last 8 digits
            $nextNumber = $lastNumber + 1;
        };

        // Pad the number to ensure it's 8 digits long
        $logId = $datePrefix . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

        // Create a new game log
        $result = (rand(0, 1) == 0) ? 'head' : 'tail';
        HeadAndTailLog::create([
            'game_id' => 1,
            'status' => 'running',
            'result' => $result,
            'log_id' => $logId,
        ]);

        // Get one hour before current time
        $dateTime = Carbon::now()->subHour();

        // Fetch all the game logs older than one hour
        $oldGameLogs = HeadAndTailLog::where('created_at', '<=', $dateTime)
            ->where('status', 'stopped')
            ->get();

        foreach ($oldGameLogs as $gameLog) {
            // Fetch the associated bets
            $logUsers = $gameLog->Bets;

            // If there are no associated bets, delete the game log
            if ($logUsers->isEmpty()) {
                $gameLog->delete();
            }
        }
    }
}
