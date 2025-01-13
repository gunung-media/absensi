<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only(['username', 'password']), $request->boolean('remember'))) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['error' => 'Password tidak cocok']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
