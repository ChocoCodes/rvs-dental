<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthenticateLoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index() {
        return view('pages.login');
    }

    public function authenticate(AuthenticateLoginRequest $request) {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()
                ->withErrors([
                    'email' => 'No account found with this email.'
                ])
                ->onlyInput('email');
        }

        // Check password hash if correct
        if (!Hash::check($request->password, $user->password)) {
            return back()
                ->withErrors([
                    'password' => 'Incorrect password. Please try again.'
                ])
                ->onlyInput('email');
        }

        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->intended('/appointments');
    }

    public function logout(Request $request) {
        Auth::logout();

        // Invalidate user session
        $request->session()->invalidate();

        // Regenerate CSRF Token
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
