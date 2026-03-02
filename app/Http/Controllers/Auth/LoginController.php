<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Handle user authentication.
 *
 * This controller provides the login and logout functionality for the
 * application. After a successful login the user will be redirected
 * to the intended page or the dashboard. If the user has not yet
 * verified their email address, they will be redirected to the
 * verification notice.
 */
class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            // Redirect users who haven't verified their email to the verification notice
            if (! $request->user()->hasVerifiedEmail()) {
                Auth::logout();
                return redirect()->route('verification.notice')->with('status', 'Debes verificar tu correo electrónico antes de continuar.');
            }
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}