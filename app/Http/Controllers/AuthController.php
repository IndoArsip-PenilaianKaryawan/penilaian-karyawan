<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\M_admin;
use App\Models\M_karyawan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {



        if (Auth::guard('user')->check()) {
            return redirect('penilai');
        }

        if (Auth::guard('admin')->check()) {
            return redirect('admin');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'username' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9]+$/'],
                'password' => ['required', 'string', 'min:6', 'regex:/^[a-zA-Z0-9]+$/'],
            ]);

            $credentials = $request->only('username', 'password');
            $admin = M_admin::where('username', $credentials['username'])->first();
            $user = M_karyawan::where('no_pegawai', $credentials['username'])->first();


            if ($admin && $credentials['username'] === $admin->username && Hash::check($credentials['password'], $admin->password)) {
                Auth::guard('admin')->login($admin);
                return redirect()->intended('admin');
            }

            else if ($user && $credentials['username'] === $user->no_pegawai && Hash::check($credentials['password'], $user->password)) {
                Auth::guard('user')->login($user);
                return redirect()->intended('penilai');
            }
            else {
                return back()->withErrors([
                    'msg' => 'Username atau password salah.',
                ]);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors());
        }
    }


    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('login');
    }

    public function __construct()
    {
        $this->middleware('throttle:5,1')->only('login');
    }

}
