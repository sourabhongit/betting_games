<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\DragonTigerBet;
use App\Models\HeadAndTailBet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class WalletController extends Controller
{
    public function wallet()
    {
        try {
            $wallet = Wallet::where('user_id', auth()->user()->id)->select('balance', 'id')->first();
            $transactions = Transaction::where('wallet_id', $wallet->id)->orderByDesc('created_at')->get();
            // Ensure that the user is authenticated
            if (!$wallet || !$transactions) {
                return redirect()->route('login')->withErrors('You need to login to access the wallet');
            }
            return view('frontend.wallet.index', compact('wallet', 'transactions'));
        } catch (\Throwable $th) {
            // Handle or log the exception
            Log::error($th->getMessage());
            return redirect()->back()->withErrors('An error occurred while trying to access the wallet.');
        }
    }

    // During head and tail game, update player wallet on win/loss
    public function HeadTailWalletUpdate(Request $request)
    {
        $ValidatedData = $request->validate([
            'user_id' => 'required|numeric',
            'log_id' => 'required|numeric',
            'result' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $Wallet = Wallet::where('user_id', $ValidatedData['user_id'])->firstOrFail();
            $Bets = HeadAndTailBet::where('log_id', $ValidatedData['log_id'])
                ->where('user_id', $ValidatedData['user_id'])
                ->get();

            foreach ($Bets as $Bet) {
                if ($Bet->bet_on == $ValidatedData['result']) {
                    $Wallet->balance += $Bet->bet_amount;
                    $Bet->win_lost = 'win';
                } else {
                    $Wallet->balance -= $Bet->bet_amount;
                    $Bet->win_lost = 'lost';
                }

                $Bet->result = $ValidatedData['result'];

                Transaction::create([
                    'wallet_id' => $Wallet->id,
                    'amount' => $Bet->bet_amount,
                    'cr_dr' => $Bet->bet_on == $ValidatedData['result'] ? 'credit' : 'debit',
                    'type' => $Bet->win_lost,
                    'wallet_balance' => $Wallet->balance,
                ]);

                $Bet->save();
            }

            // Save the wallet once after updating all logs
            $Wallet->save();

            DB::commit();
            return response()->json([
                'message' => 'Wallet updated successfully.'
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th);
            return response()->json([
                'error' => 'An error occurred while processing your request.'
            ], 400);
        }
    }
    public function DragonTigerWalletUpdate(Request $request)
    {
        $ValidatedData = $request->validate([
            'user_id' => 'required|numeric',
            'log_id' => 'required|numeric',
            'result' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $Wallet = Wallet::where('user_id', $ValidatedData['user_id'])->firstOrFail();
            $Bets = DragonTigerBet::where('log_id', $ValidatedData['log_id'])
                ->where('user_id', $ValidatedData['user_id'])
                ->get();

            foreach ($Bets as $Bet) {
                if ($Bet->bet_on == $ValidatedData['result']) {
                    if ($Bet->bet_on == 'dragon' || $Bet->bet_on == 'tiger') {
                        $Wallet->balance += ($Bet->bet_amount * 2);
                        $Bet->win_lost = 'win';
                    } else if ($Bet->bet_on == 'tie') {
                        $Wallet->balance += ($Bet->bet_amount * 9);
                        $Bet->win_lost = 'win';
                    }
                } else {
                    $Wallet->balance -= $Bet->bet_amount;
                    $Bet->win_lost = 'lost';
                }

                $Bet->result = $ValidatedData['result'];

                Transaction::create([
                    'wallet_id' => $Wallet->id,
                    'amount' => $Bet->bet_amount,
                    'cr_dr' => $Bet->bet_on == $ValidatedData['result'] ? 'credit' : 'debit',
                    'type' => $Bet->win_lost,
                    'wallet_balance' => $Wallet->balance,
                ]);

                $Bet->save();
            }

            // Save the wallet once after updating all logs
            $Wallet->save();

            DB::commit();
            return response()->json([
                'message' => 'Wallet updated successfully.'
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th);
            return response()->json([
                'error' => 'An error occurred while processing your request.'
            ], 400);
        }
    }

    // Fetch player wallet balance
    public function getBalance($id)
    {
        $wallet = Wallet::where('user_id', $id)->first();
        if (!$wallet) {
            return response()->json([
                'error' => 'No wallet found for this user.'
            ], 404);
        }
        return response()->json([
            'balance' => $wallet->balance
        ], 200);
    }
}
