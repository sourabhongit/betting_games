<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dragon_tiger_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('session_id')->unique();
            $table->enum('status', ['running', 'stopped']);
            $table->string('result')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dragon_tiger_logs');
    }
};
