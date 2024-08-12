<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    public function login()
    {
        return view('frontend.user.login');
    }
    // Login authentication
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $user = User::where('email', $request->email)->first();
        if ($user && $user->roles()->first()) {
            $roleName = $user->roles()->first()->name;
            if ($roleName == 'player') {
                return redirect()->route('home');
            } else {
                Auth::guard('web')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->back()->with('error', "User doesn't have permission to access.");
            }
        } else {
            return redirect()->back()->with('error', "User doesn't have permission to access.");
        }
    }

    public function register()
    {
        return view('frontend.user.register');
    }

    public function registerStore(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
            'number' => ['required', 'string', 'max:15'],
        ]);

        try {
            // Create user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->number,
                'password' => Hash::make($request->password),
            ]);

            $user->assignRole('player');

            // Create wallet
            $user->wallet()->create(['balance' => 0]);

            // Login user with user details
            Auth::login($user);

            // Return success response with redirect URL
            return redirect()->route('home');
        } catch (\Throwable $th) {
            // Save error in laravel.log file
            Log::error($th);

            // Return error response
            return redirect()->back()->with('error', 'Not able to register user.');
        }
    }

    public function destroy()
    {
        Auth::guard('web')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('user.login');
    }
}
