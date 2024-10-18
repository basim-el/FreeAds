<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Mail\ActiveMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /**
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('login');
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'firstname' => $validatedData['firstname'],
            'lastname' => $validatedData['lastname'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'remember_token' => Str::random(60),
        ]);

        // auth()->login($user);
        Mail::to($user->email)->send(new ActiveMail($user));

        return redirect()->route('login');
    }

    public function activate($token)
    {
        try {
            $user = User::where('remember_token', $token)->firstOrFail();
            $user->markEmailAsVerified();
            $user->remember_token = null;
            $user->email_verified_at = now();
            $user->save();


            return redirect()->route('login')->with('success', 'Your account has been activated!');
        } catch (ModelNotFoundException) {
            return redirect()->route('login')->with('error', 'Invalid activation token');
        }
    }
}
