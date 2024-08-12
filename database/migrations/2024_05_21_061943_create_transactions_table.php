<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->string('id', 15)->primary();
            $table->foreignId('wallet_id')->references('id')->on('wallets')->onDelete('cascade');
            $table->decimal('amount', 15, 2);
            $table->enum('cr_dr', ['credit', 'debit']);
            $table->enum('type', ['win', 'lost', 'add money', 'withdrawal']);
            $table->integer('wallet_balance');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
