<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($attributes)) {
            // Obtener el modelo del usuario autenticado
            $user = Auth::user();
            // Actualizar el campo last_login_at del usuario
            $user->last_login_at = now();
            $user->save();

            session()->regenerate();
            return redirect()->intended(route('dashboard'))->with(['success' => 'You are logged in.']);
        } else {

            return back()->withErrors(['email' => 'Email or password invalid.']);
        }
    }

    public function destroy()
    {

        Auth::logout();

        return redirect('/login')->with(['success' => 'You\'ve been logged out.']);
    }
}
