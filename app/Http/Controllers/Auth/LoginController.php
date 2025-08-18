<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Logic for handling login
        $credientials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:1',
        ]);

        // When creditentials are valid, you would typically authenticate the user
        if (Auth::attempt($credientials)) {
            return redirect()->intended('dashboard');
        } else {
            return back()->withErrors([
                'email' => __('auth.invalid_login'),
            ]);
        }
    }
}
