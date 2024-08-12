<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dragon_tiger_bets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('log_id')->constrained('dragon_tiger_logs')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('bet_amount');
            $table->string('bet_on');
            $table->string('result')->nullable();
            $table->string('win_lost')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dragon_tiger_bets');
    }
};
