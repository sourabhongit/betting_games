<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DragonTigerBet;
use App\Models\DragonTigerLog;
use Illuminate\Support\Facades\Log;

class DragonTigerBetController extends Controller
{
    public function index()
    {
        $GameLog = DragonTigerLog::where('status', 'running')->latest()->first();
        $Bets = DragonTigerBet::where('log_id', $GameLog->id)->get();

        // Calculate the total bet amounts
        $DragonBetAmount = $Bets->where('bet_on', 'dragon')->sum('bet_amount');
        $TigerBetAmount = $Bets->where('bet_on', 'tiger')->sum('bet_amount');
        $TieBetAmount = $Bets->where('bet_on', 'tie')->sum('bet_amount');

        // Count the total players
        $TotalPlayes = $Bets->count();

        // Get the latest GameLog entry
        $Results = DragonTigerBet::orderBy('created_at', 'desc')->limit(100)->get();
        return view('backend.DragonTigerResult.Index', compact('Results', 'GameLog', 'DragonBetAmount', 'TigerBetAmount', 'TieBetAmount', 'TotalPlayes'));
    }

    public function ResultUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'Result' => 'required|string',
            'GameLogId' => 'required|numeric',
        ]);

        try {
            // Fetch GameLogUsers by game_log_id
            $GameLog = DragonTigerLog::find($validatedData['GameLogId']);
            $GameLog->result = $validatedData['Result'];
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

    public function RunningGameData($id)
    {
        try {
            // Fetch GameLogUsers by game_log_id
            $Bet = DragonTigerBet::where('log_id', $id)->get();

            // Calculate the total bet amounts
            $DragonBetAmount = $Bet->where('bet_on', 'dragon')->sum('bet_amount');
            $TigerBetAmount = $Bet->where('bet_on', 'tiger')->sum('bet_amount');
            $TieBetAmount = $Bet->where('bet_on', 'tie')->sum('bet_amount');

            // Count the total players
            $TotalPlayes = $Bet->count();
            return response()->json([
                'DragonBetAmount' => $DragonBetAmount,
                'TigerBetAmount' => $TigerBetAmount,
                'TieBetAmount' => $TieBetAmount,
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
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'log_id' => 'required|integer',
            'bet_amount' => 'required|integer|min:10',
            'bet_on' => 'required|string',
        ]);

        try {
            $conditions = [
                ['user_id', $validatedData['user_id']],
                ['log_id', $validatedData['log_id']],
                ['bet_on', $validatedData['bet_on']]
            ];
            $oldGameLog = DragonTigerBet::where($conditions)->first();
            if ($oldGameLog) {
                // Update the existing game log record with the new bet amount
                $oldGameLog->update([
                    'bet_amount' => $validatedData['bet_amount'],
                ]);
            } else {
                $gameLog = DragonTigerBet::create([
                    'user_id' => $validatedData['user_id'],
                    'log_id' => $validatedData['log_id'],
                    'bet_amount' => $validatedData['bet_amount'],
                    'bet_on' => $validatedData['bet_on'],
                ]);
            };

            // Return the result and win/loss as a JSON response
            return response()->json([
                'message' => 'success',
            ], 200);
        } catch (\Throwable $th) {
            // Return the exception message as a JSON response
            return response()->json([
                'error' => $th->getMessage()
            ], 400);
        }
    }
}
