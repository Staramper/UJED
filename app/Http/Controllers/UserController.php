<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{

    public function index()
    {
        return view('administrar');
    }

    public function listar()
    {
        $users = User::all();

        return $users;
    }

    public function show(User $id)
    {
        $id->role = 'hola mundo';
        $id->update();
        return $id;
    }

    public function store(Request $request)
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'nick' => ['required', 'string', 'max:255', 'unique:users'],
            'tel' => ['required', 'string', 'max:255', 'unique:users', 'regex:/^[0-9]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:30'],
        ],[
            'name.required'     => 'El Nombre es requerido', // Mensaje presonalizado
            'nick.required'     => 'El Nick es requerido',
            'nick.unique'       => 'El Nick ya esta en uso',
            'tel.required'      => 'El Telefono es requerido',
            'tel.unique'        => 'El Telefono ya esta en uso',
            'tel.regex'         => 'El campo tel solo puede contener números.',
            'email.required'    => 'El Email es requerido',
            'email.unique'      => 'El Email ya esta en uso',
            'password.required' => 'La contraseña es requerida',
            'password.min'      => 'La contraseña debe de tener 8 caracteres minimo',
            'password.max'      => 'La contraseña es muy larga, intenta con ingresar otra',
        ]);
        
        User::create([
            'name' => $data['name'],
            'nick' => $data['nick'],
            'tel' => $data['tel'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function update(Request $request, User $id)
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'nick' => ['required', 'string', 'max:255', 'unique:users,nick,'.$id->id],
            'tel' => ['required', 'string', 'max:255', 'unique:users,tel,'.$id->id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id->id],
            'role' => ['required', 'string', 'min:4'],
        ],[
            'name.required'  => 'El Nombre es requerido', // Mensaje presonalizado
            'nick.required'  => 'El Nick es requerido',
            'nick.unique'    => 'El Nick ya esta en uso',
            'tel.required'   => 'El Telefono es requerido',
            'tel.unique'     => 'El Telefono ya esta en uso',
            'email.required' => 'El Email es requerido',
            'email.unique'   => 'El Email ya esta en uso', 
        ]);
        
        $id->update($data);

    }

    public function edit_dom(Request $request, User $id)
    {
        $id->update($request->all());
    }



    public function destroy(User $id)
    {
        $id->delete();
    }
}
