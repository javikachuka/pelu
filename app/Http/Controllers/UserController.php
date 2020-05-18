<?php

namespace App\Http\Controllers;

use App\Direccion;
use App\Empresa;
use App\Rubro;
use App\User;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Cardumen\ArgentinaProvinciasLocalidades\Models\Pais;
use Cardumen\ArgentinaProvinciasLocalidades\Models\Provincia;
use Cardumen\ArgentinaProvinciasLocalidades\Models\Localidad;
use Exception;
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

    public function delete(Request $request, $id)
    {

        $usuarioSesion = auth()->user();
        $user = User::find($id);

        if (is_null($user)) {
            return redirect()->back()->withErrors('No existe el usuario');
        }
        // if ($usuarioSesion->empresa->id != $user->empresa->id) {

        //     return redirect()->back()->withErrors('No se puede eliminar');
        // }
        if ($user->admin) {
            return redirect()->back()->withErrors('El usuario no puede ser borrado');
        }

        if ($user->delete()) {
            return redirect()->back()->with('warning', 'Se borro el usuario con exito');
        }
        return redirect()->back()->withErrors('No se pudo eliminar el usuario');
    }

    public function createRegistroClientesEmpresa($slug){

        $empresa = Empresa::where('slug' ,$slug)->firstOrFail() ;
        return view('users.registroClientes', compact('empresa')) ;
    }


    public function createRegistroClientes(){

        return view('users.registroClientes') ;
    }

    function createRegistroEmpresa(){
        $paises = Pais::all();
        $rubros = Rubro::all();
        return view('users.registroEmpresa' , compact('paises', 'rubros')) ;
    }

    public function saveRegistroEmpresa(Request $request){
        request()->validate([
            'name' => 'required|max:255',
            'apellido' => 'required|max:255',
            'dni' => 'required|min:10',
            'fecha_nacimiento' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|same:password_confirmation',
            'password_confirmation' => 'min:8',
            'nombreEmpresa' => 'required|max:255',
            'rubro_id' => 'required',
            'emailEmpresa' => 'required|email|unique:empresas,email',
            'telefonoEmpresa' => 'required',
            'pais_id' => 'required',
            'provincia_id' => 'required',
            'localidad_id' => 'required',
            'calle' => 'required|max:100',
        ]);

        $direccion = new Direccion();
        $direccion->calle = $request->calle ;
        $direccion->pais_id = $request->pais_id ;
        $direccion->provincia_id = $request->provincia_id ;
        $direccion->localidad_id = $request->localidad_id ;
        $direccion->save();


        $empresa = new Empresa();
        $empresa->nombre = $request->nombreEmpresa;
        $empresa->email = $request->emailEmpresa;
        //falta corregir cambiar espacios por _
        $empresa->slug = strtoupper($request->nombreEmpresa);
        $empresa->telefono = $request->telefonoEmpresa;
        $empresa->direccion_id = $direccion->id;
        //falta agregar un inpiut en la view
        $empresa->cantidadPersonas = 1;
        $empresa->save();
        $empresa->rubros()->sync($request->rubro_id) ;

        $usuario= new User();
        $usuario->name = $request->name ;
        $usuario->apellido = $request->apellido ;
        $usuario->dni = $request->dni ;
        $usuario->fecha_nacimiento = $request->fecha_nacimiento ;
        $usuario->email = $request->email ;
        $usuario->password = Hash::make($request->password) ;
        $usuario->empresa_id = $empresa->id;
        $usuario->save() ;


        return redirect()->route('login');

    }
}
