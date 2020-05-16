<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function index($slug)
    {
        $empresa = Empresa::where('slug', $slug)->first();
        return view('empresa.index', compact('empresa'));

    }
}
