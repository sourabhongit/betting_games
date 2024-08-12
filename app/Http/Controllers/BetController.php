<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeadAndTailBet;
use App\Models\HeadAndTailLog;
use Illuminate\Support\Facades\Log;

class BetController extends Controller
{
    public function index()
    {
        // Fetch GameLogUsers by game_log_id
        $GameLog = HeadAndTailLog::where('status', 'running')->latest()->first();
        $Bets = HeadAndTailBet::where('log_id', $GameLog->id)->get();

        // Calculate the total bet amounts
        $TailBetAmount = $Bets->where('bet_on', 'tail')->sum('bet_amount');
        $HeadBetAmount = $Bets->where('bet_on', 'head')->sum('bet_amount');

        // Count the total players
        $TotalPlayes = $Bets->count();

        // Get the latest GameLog entry
        $Results = HeadAndTailBet::latest()->limit(100)->get();
        return view('backend.HeadTailResult.index', compact('Results', 'GameLog', 'TailBetAmount', 'HeadBetAmount', 'TotalPlayes'));
    }

    public function ResultUpdate(Request $request)
    {
        $ValidatedData = $request->validate([
            'Result' => 'required|string',
            'GameLogId' => 'required|numeric',
        ]);

        try {
            // Fetch GameLogUsers by game_log_id
            $GameLog = HeadAndTailLog::find($ValidatedData['GameLogId']);
            $GameLog->result = $ValidatedData['Result'];
            $GameLog->update();

            // Return the response
            return response()->json([
                'message' => 'Result updated successfully',
            ], 200);
        } catch (\Throwable $th) {
            // Log the error and return an error response
            Log::error('Error in resultUpdate: ' . $th->getMessage());

            return response()->json([
                'error' => 'An error occurred while updating the result.',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function HeadTailRunningGameData($id)
    {
        try {
            // Fetch GameLogUsers by game_log_id
            $GameLogUsers = HeadAndTailBet::where('log_id', $id)->get();

            // Calculate the total bet amounts
            $TailBetAmount = $GameLogUsers->where('bet_on', 'tail')->sum('bet_amount');
            $HeadBetAmount = $GameLogUsers->where('bet_on', 'head')->sum('bet_amount');

            // Count the total players
            $TotalPlayes = $GameLogUsers->count();
            return response()->json([
                'TailBetAmount' => $TailBetAmount,
                'HeadBetAmount' => $HeadBetAmount,
                'TotalPlayes' => $TotalPlayes,
            ], 200);
        } catch (\Throwable $th) {
            // Log the error and return an error response
            Log::error('Error in resultUpdate: ' . $th->getMessage());

            return response()->json([
                'error' => 'An error occurred while updating the result.',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function PlaceBet(Request $request)
    {
        // Validate the request data
        $ValidatedData = $request->validate([
            'log_id' => 'required|integer',
            'user_id' => 'required|integer',
            'bet_amount' => 'required|integer|min:10',
            'bet_on' => 'required|string',
        ]);
        try {
            $conditions = [
                ['user_id', $ValidatedData['user_id']],
                ['bet_on', $ValidatedData['bet_on']],
                ['log_id', $ValidatedData['log_id']],
            ];

            $oldGameLog = HeadAndTailBet::where($conditions)->first();

            if ($oldGameLog) {
                // Update the existing game log record with the new bet amount
                $oldGameLog->update(['bet_amount' => $ValidatedData['bet_amount']]);
            } else {
                $GameLogData = [
                    'user_id' => $ValidatedData['user_id'],
                    'bet_amount' => $ValidatedData['bet_amount'],
                    'bet_on' => $ValidatedData['bet_on'],
                    'log_id' => $ValidatedData['log_id'],
                ];

                HeadAndTailBet::create($GameLogData);
            }

            // Return the result and win/loss as a JSON response
            return response()->json(['message' => 'success'], 200);
        } catch (\Throwable $th) {
            // Return the exception message as a JSON response
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }
}
