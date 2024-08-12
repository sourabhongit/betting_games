<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\HeadAndTailBet;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
	public function dashboard()
	{
		if (auth()->check() && auth()->user()->hasRole('admin')) {
			$Today = Carbon::now()->startOfDay();
			$UserCount = User::Role('player')->count();
			$TotalBet = HeadAndTailBet::sum('bet_amount');
			$TotalBetToday = HeadAndTailBet::where('created_at', '>=', $Today)->where('created_at', '<', $Today->copy()->addDay())->sum('bet_amount');
			return view('dashboard', compact('UserCount', 'TotalBet', 'TotalBetToday'));
		} else {
			return redirect()->route('login');
		}
	}

	public function changePassword(Request $request)
	{
		if ($request->new_password == $request->confirm_password) {
			$user = User::where('id', auth()->user()->id)->first();
			if ($user) {
				if (password_verify($request->current_password, $user->password)) {
					$user->password = bcrypt($request->new_password);
					if ($user->update()) {
						Auth::guard('web')->logout();
						$request->session()->invalidate();
						$request->session()->regenerateToken();
						return redirect()->route('login')->with('message', 'Password updated successfully. Login with new password');
					} else {
						return redirect()->route('profile')->with("error", "An error occurred. Please try again.");
					}
				} else {
					return redirect()->route('profile')->with("error", "Old password dosen't match our records. Please try again.");
				}
			} else {
				return redirect()->route('profile')->with("error", "An error occurred. Please try again.");
			}
		} else {
			return redirect()->route('profile')->with("error", "New Password and Confirm Password should be same. Please try again.");
		}
	}
}
