<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers {
        logout as performLogout;
    }

    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'showAdminLoginForm', 'adminLogin']);
    }

    // Standard Login (Customers)
    public function login(Request $request)
    {
        $request->validate(['email' => 'required|email', 'password' => 'required']);

        if (Auth::attempt($request->only('email', 'password'))) {
            return Auth::user()->role === 'admin' ? redirect('/admin') : redirect('/home');
        }
        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    // Admin Login (Dedicated)
    public function showAdminLoginForm() { return view('auth.login'); }

    public function adminLogin(Request $request)
    {
        $request->validate(['email' => 'required|email', 'password' => 'required']);

        if (Auth::attempt($request->only('email', 'password'))) {
            if (Auth::user()->role === 'admin') {
                return redirect('/admin');
            }
            Auth::logout();
            return back()->withErrors(['email' => 'Unauthorized: Admin access only.']);
        }
        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        $this->performLogout($request);
        return redirect('/');
    }
}