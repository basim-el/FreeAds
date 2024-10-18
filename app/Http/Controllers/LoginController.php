<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->email_verified_at == null) {
                return redirect('/login')->withErrors(['email' => 'Email not verified']);
            }

            return redirect()->route('profil', ['id' => $user->id]);
        }

        if (User::where('email', $credentials['email'])->exists()) {
            return back()->withErrors([
                'password' => 'Mot de passe invalide.',
            ]);
        } else {
            return back()->withErrors([
                'email' => 'Email invalide.',
            ]);
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
