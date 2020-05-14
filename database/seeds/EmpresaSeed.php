<?php

use App\Empresa;
use Illuminate\Database\Seeder;

class EmpresaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $empresa= Empresa::create([
            'nombre'=>'Barberia Jaime',
            'slug'=>'BARBERIA_JAIME',
            'email'=>'BarbeJaime@gmail.com',
            'cantidadPersonas'=>2]);
    }
}
