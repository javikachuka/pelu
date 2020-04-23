<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $users = User::all();
        return view('users.create');
    }


    public function save(Request $request)
    {


        $this->validacionUsuariosEntrada($request);

        $user = new User();
        $user->name = $request->name;
        $user->apellido = $request->apellido;
        $user->dni = $request->dni;
        $user->fecha_nacimiento = $request->fecha_nacimiento;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('users.index');
    }

    private function validacionUsuariosEntrada(Request $request)
    {
        $rules = [
            'name'    =>  'required|max:255',
            'apellido'    =>  'required|max:255',
            'dni'    =>  'required|integer',
            'fecha_nacimiento'    =>  'required|before:today',
            'email'    =>  'required|unique:users',
            'password'    =>  'required',
        ];

        $mensaje = [
            'fecha_nacimiento.before' => 'La fecha de nacimiento tiene que ser menor al ' . Date('d/m/Y')
        ];

        $this->validate($request, $rules, $mensaje);
    }
}
