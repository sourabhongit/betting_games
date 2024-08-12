<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('head_and_tail_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('session_id')->unique();
            $table->enum('status', ['running', 'stopped']);
            $table->string('result')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('head_and_tail_logs');
    }
};
