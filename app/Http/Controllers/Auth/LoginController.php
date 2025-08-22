<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function index(): View
    {
        return view('auth.login');
    }

    /**
     * Handle the login request.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $this->validateLoginData($request);

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        } else {
            return back()->withErrors([
                'email' => __('auth.invalid_login'),
            ]);
        }
    }

    /**
     * Handle the logout request.
     *
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('login');
    }

    private function validateLoginData(Request $request): array
    {
        return $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:1',
        ]);
    }
}
