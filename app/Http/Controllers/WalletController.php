<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WalletController extends Controller
{
    public function index()
    {
        try {
            $userWallets = Wallet::get();
            return view('backend.wallet.index', compact('userWallets'));
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->with('error', "Not Able to Fetch Wallet Details");
        }
    }

    public function create()
    {
        try {
            $users = User::role('player')->get();
            return view('backend.wallet.create', compact('users'));
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->route('user.wallet.index')->with('error', 'Not Able to Fectch The Users');
        }
    }

    public function store(Request $req)
    {
        try {
            $userIds = $req->user_ids;
            $transType = $req->transaction_type;
            foreach ($userIds as $userId) {
                DB::beginTransaction();
                $userWallet = Wallet::where('user_id', $userId)->first();
                if ($userWallet) {
                    $userWallet->balance = $transType == 0 ? $userWallet->balance + $req->amount : $userWallet->balance - $req->amount;
                    if ($userWallet->balance > 0) {
                        if ($userWallet->save()) {
                            $this->createTransactions($userWallet->id, $req->amount, $transType, $userWallet->balance);
                        }
                    } else {
                        return redirect()->route('user.wallet.index')->with('error', "User wallet can't be less than 0");
                    }
                } else {
                    $wallet = new Wallet();
                    $wallet->user_id = $userId;
                    $wallet->balance = $transType == 0 ? $wallet->balance + $req->amount : $wallet->balance - $req->amount;
                    if ($wallet->balance > 0) {
                        if($wallet->save()) {
                            $this->createTransactions($wallet->id, $req->amount, $transType, $wallet->balance);
                        }
                    } else {
                        return redirect()->route('user.wallet.index')->with('error', "User wallet can't be less than 0");
                    }
                }
                DB::commit();
            }
            return redirect()->route('user.wallet.index')->with('message', 'Wallet Operation Successfully');
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();
            return redirect()->back()->with('error', 'Not able to crate or update the wallet. Try again.');
        }
    }

    public function createTransactions($wallet_id, $amount, $transType, $balance)
    {
        $transaction = new Transaction();
        $transaction->wallet_id = $wallet_id;
        $transaction->amount = $amount;
        $transaction->type = $transType == 0 ? 'credit' : 'debit';
        $transaction->wallet_balance = $balance;
        $transaction->save();
    }
}
