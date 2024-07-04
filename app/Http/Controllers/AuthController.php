<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\M_admin;
use App\Models\M_users;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {

        if (Auth::guard('user')->check()) {
            return redirect('penilai');
        }

        if (Auth::guard('admin')->check()) {
            // dd(Auth::guard('admin'));
            return redirect('admin');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        $admin = M_admin::where('username', $credentials['username'])->first();
        $user = M_users::where('username', $credentials['username'])->first();
        if ($admin && $credentials['username'] === $admin->username && $credentials['password'] == $admin->password) {
            Auth::guard('admin')->login($admin);
            return redirect()->intended('admin');
        } else if ($user && $credentials['username'] === $user->username && $credentials['password'] == $user->password) {
            Auth::guard('user')->login($user);
            return redirect()->intended('penilai');
        } else {
            return back()->withErrors([
                'msg' => 'salah',
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('login');
    }
}
