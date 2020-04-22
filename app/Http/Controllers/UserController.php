<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users = User::all() ;
        return view('users.index' , compact('users')) ;
    }

    public function create(){
        $users = User::all() ;
        return view('users.create') ;
    }


    public function save(Request $request){


        $user = new User() ;
        $user->name = $request->name;
        $user->apellido = $request->apellido;
        $user->dni = $request->dni;
        $user->fecha_nacimiento = $request->fecha_nacimiento;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save() ;
        return redirect()->route('users.index');

    }

}
