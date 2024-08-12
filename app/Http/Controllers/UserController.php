<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(): view
    {
        try {
            $users = User::with('roles')->orderBy('name', 'asc')->get();
            return view('backend.user.index', compact('users'));
        } catch (\Throwable $th) {
            Log::error($th);
            return back()->with('error', 'Users Not Found');
        }
    }

    public function create()
    {
        try {
            $roles = Role::where('guard_name', 'web')->get();
            return view('backend.user.create', compact('roles'));
        } catch (\Throwable $th) {
            Log::error($th);
            return back()->with('error', 'Not Able to Fetch Roles');
        }
    }

    public function store(Request $request)
    {
        try {
            if ($request->password == $request->confirm_password) {
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->phone_number = $request->phone_number;
                $user->password = bcrypt($request->password);
                foreach ($request->role as $role) {
                    $user->assignRole($role);
                }
                if ($user->save()) {
                    return redirect()->route('user.index')->with('message', 'User Created Successfully');
                }
            } else {
                return redirect()->route('user.index')->with('error', 'New Password and Confirm Password should be same. Please try again.');
            }
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->route('user.index')->with('message', 'An error occurred. Please try again.');
        }
    }

    public function show($id)
    {
        try {
            $user = User::with('roles')->where('id', $id)->select('id', 'name', 'phone_number', 'email')->first();
            return view('backend.user.show', compact('user'));
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->route('user.index')->with('error', 'Not Able to Fetch User Data.');
        }
    }

    public function edit($id)
    {
        $user = User::with('roles')->where('id', $id)->first();
        $userRole = $user->roles->pluck('name')->first();
        $roles = Role::where('guard_name', 'web')->get();
        return view('backend.user.edit', compact('user', 'userRole', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::with('roles')->where('id', $id)->first();
        if ($user) {
            if ($request->password == $request->confirm_password) {
                $user->name = $request->name;
                $user->email = $request->email;
                $user->phone_number = $request->phone_number;
                if ($request->password) {
                    $user->password = bcrypt($request->password);
                }
                if ($user->update()) {
                    return redirect()->route('user.index')->with('message', 'User Updated Successfully');
                } else {
                    return redirect()->route('user.index')->with('message', 'An error occurred. Please try again.');
                }
            } else {
                return redirect()->route('user.index')->with('error', "New Password and Confirm Password doesn't match. Please check.");
            }
        } else {
            return redirect()->route('user.index')->with('message', 'An error occurred. Please try again.');
        }
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        if ($user->delete()) {
            return redirect()->route('user.index')->with('message', 'User Deleted Successfully');
        } else {
            return redirect()->route('user.index')->with('error', 'An error occurred. Please try again.');
        }
    }

    public function assignRole(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if ($user) {
            if ($user->assignRole($request->role)) {
                return redirect()->route('user.index')->with('message', 'Role assigned successfully');
            } else {
                return redirect()->route('user.index')->with('error', 'An error occurred. Please try again.');
            }
        } else {
            return redirect()->route('user.index')->with('error', 'An error occurred. Please try again.');
        }
    }

    public function revokeRole(Request $request)
    {
        $role = Role::where('name', $request->role)->first();
        if ($role) {
            if (DB::table('model_has_roles')->where('model_id', $request->id)->where('role_id', $role->id)->delete()) {
                return redirect()->route('user.index')->with('message', 'Role revoked successfully');
            } else {
                return redirect()->route('user.index')->with('error', 'An error occurred. Please try again.');
            }
        } else {
            return redirect()->route('user.index')->with('error', 'An error occurred. Please try again.');
        }
    }

    public function forceDelete($id)
    {
        $user = User::where('id', $id)->first();
        if ($user->forceDelete()) {
            return redirect()->route('user.index')->with('message', 'User Permanently Deleted.');
        } else {
            return redirect()->route('user.index')->with('error', 'An error occurred. Please try again.');
        }
    }
}
