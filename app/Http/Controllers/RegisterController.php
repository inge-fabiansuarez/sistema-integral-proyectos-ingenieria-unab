<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    public function registerSameUserCreate()
    {
        return view('session.register-same-user');
    }

    public function registerSameUserStore()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
            'agreement' => ['accepted']
        ]);
        $attributes['password'] = bcrypt($attributes['password']);



        session()->flash('success', 'Your account has been created.');
        $user = User::create($attributes);
        Auth::login($user);
        $user->last_login_at = now();
        $user->assignRole('Estudiante');
        $user->save();
        return redirect()->route('userprofil.index');
    }

    public function create()
    {
        //dd("HIOS");
        return view('session.register');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
            'agreement' => ['accepted'],
            'phone' => ['required'],
            'location' => ['required'],
            'about_me' => ['required'],
        ]);
        $attributes['password'] = bcrypt($attributes['password']);

        //session()->flash('success', 'Your account has been created.');
        $user = User::create($attributes);
        //Auth::login($user);
        return redirect()->to('user.index');
    }


    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', ['user' => $user, 'roles' => $roles]);
    }

    public function update(Request $request, User $user)
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore($user->id)],
            'phone'     => ['max:50'],
            'location' => ['max:70'],
            'about_me'    => ['max:150'],
        ]);

        User::where('id', $user->id)
            ->update([
                'name'    => $attributes['name'],
                'email' => $attributes['email'],
                'phone'     => $attributes['phone'],
                'location' => $attributes['location'],
                'about_me'    => $attributes["about_me"],
            ]);

        $user->syncRoles($request->roles);

        return redirect()->route('user.edit', $user)->with('success', 'Perfil Actualizado correctamente!!!');
    }

    public function destroy(User $user)
    {
        if ($user->id != auth()->user()->id) {
            $user->delete();
            return redirect()->route('user.roles.index')->with('msg', ['class' => 'danger', 'body' => 'Rol eliminado con éxito']);
        } else {
            return redirect()->route('user.roles.index')->with('msg', ['class' => 'danger', 'body' => 'No se pudo eliminar, el usuario que quieres eliminar, es el que has iniciado sesión']);
        }
    }
}
