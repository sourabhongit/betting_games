<?php

use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

if (!function_exists('walletTransaction')) {
  function walletTransaction($userId, $amount, $type, $cr_dr)
  {
    // Check if the wallet exists
    $wallet = Wallet::where('user_id', $userId)->first();

    if (!$wallet) {
      // Handle case where wallet does not exist, e.g., log an error
      throw new \Exception('Wallet not found for user ID: ' . $userId);
    }

    // Start a database transaction
    DB::beginTransaction();

    try {
      // Perform the transaction
      if ($cr_dr == 0) {
        // Credit
        $wallet->balance += $amount;
        $transactionType = 'credit';
      } elseif ($cr_dr == 1) {
        // Debit
        $wallet->balance -= $amount;
        $transactionType = 'debit';
      } else {
        // Handle invalid $cr_dr value
        throw new \InvalidArgumentException('Invalid cr_dr value');
      }

      // Save the wallet balance
      $wallet->save();

      // Record the transaction
      Transaction::create([
        'wallet_id' => $wallet->id,
        'amount' => $amount,
        'type' => $type,
        'cr_dr' => $transactionType,
        'wallet_balance' => $wallet->balance
      ]);

      // Commit the transaction
      DB::commit();
    } catch (\Exception $e) {
      // Rollback the transaction on error
      DB::rollBack();
      // Optionally, log the exception or handle it as needed
      throw $e;
    }
  }
}
