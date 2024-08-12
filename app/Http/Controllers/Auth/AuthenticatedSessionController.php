<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Employee;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $user = User::where('email', $request->email)->first();

        if ($user && $user->roles()->first()) {
            $roleName = $user->roles()->first()->name;
            if ($roleName == 'admin') {
                return redirect()->intended(RouteServiceProvider::HOME);
            } else {
                Auth::guard('web')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('login')->with('error', 'Your account has been disabled. Please contact management for more information');
            }
        } else {
            return redirect()->route('login')->with('error', 'Your account has been disabled. Please contact management for more information');
        }
    }


    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
