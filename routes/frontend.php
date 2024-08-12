<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\AuthController;

Route::get('user/register', [AuthController::class, 'register'])->name('user.register');