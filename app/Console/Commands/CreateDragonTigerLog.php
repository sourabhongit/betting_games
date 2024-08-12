<?php

namespace App\Console\Commands;

use App\Models\DragonTigerLog;
use Carbon\Carbon;
use App\Models\HeadAndTailLog;
use Illuminate\Console\Command;

class CreateDragonTigerLog extends Command
{
    protected $signature = 'app:create-dragon-tiger-log';
    protected $description = 'Create new records in the database every minute';

    public function handle()
    {
        // Fetch the old game log and update its status
        $gameLog = DragonTigerLog::latest()->first();
        if ($gameLog) {
            $gameLog->status = 'stopped';
            $gameLog->update();
        }

        // Generate custom session_id
        $datePrefix = now()->format('Ymd'); // Format: YYYYMMDD
        $lastLog = DragonTigerLog::where('session_id', 'like', $datePrefix . '%')
            ->orderBy('session_id', 'desc')
            ->first();

        $nextNumber = 1;

        if ($lastLog) {
            $lastNumber = (int)substr($lastLog->session_id, -5); // Extract last 5 digits
            $nextNumber = $lastNumber + 1;
        };

        // Pad the number to ensure it's 5 digits long
        $sessionId = $datePrefix . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

        // Create a new game log
        $randomNumber = mt_rand(1, 20);

        // Determine the result
        if ($randomNumber === 1) {
            $result = 'Tie';
        } else {
            $result = (mt_rand(0, 1) === 0) ? 'dragon' : 'tiger';
        }

        DragonTigerLog::create([
            'session_id' => $sessionId,
            'status' => 'running',
            'result' => $result,
        ]);

        $this->info('New game record created successfully with log_id: ' . $sessionId);

        // Get one hour before current time
        $dateTime = Carbon::now()->subHour();

        // Fetch all the game logs older than one hour
        $oldGameLogs = DragonTigerLog::where('created_at', '<=', $dateTime)
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
