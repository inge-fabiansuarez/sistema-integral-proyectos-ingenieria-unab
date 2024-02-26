<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;

class InfoUserController extends Controller
{

    public function create()
    {
        return view('laravel-examples/user-profile');
    }

    public function store(Request $request)
    {

        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            'phone'     => ['max:50'],
            'location' => ['max:70'],
            'about_me'    => ['max:150'],
            'profile_image' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);
        if ($request->get('email') != Auth::user()->email) {
            if (env('IS_DEMO') && Auth::user()->id == 1) {
                return redirect()->back()->withErrors(['msg2' => 'You are in a demo version, you can\'t change the email address.']);
            }
        } else {
            $attribute = request()->validate([
                'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            ]);
        }

        if ($request->hasFile('profile_image')) {
            // Almacena la imagen y obtén la ruta
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');

            // Actualiza el campo de la imagen en la base de datos
            User::where('id', Auth::user()->id)->update([
                'profile_image' => $imagePath,
            ]);
        }
        User::where('id', Auth::user()->id)
            ->update([
                'name'    => $attributes['name'],
                'email' => $attribute['email'],
                'phone'     => $attributes['phone'],
                'location' => $attributes['location'],
                'about_me'    => $attributes["about_me"],
            ]);


        return redirect('/user-profile')->with('success', 'Perfil actualizado correctamente');
    }
}
