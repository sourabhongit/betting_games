<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    public function index()
    {
        try {
            $transactions = Transaction::orderBy('created_at', 'desc')->get();
            return view('backend.transaction.index', compact('transactions'));
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->with('error', 'Not able to fetch the transactions');
        }
    }
}
