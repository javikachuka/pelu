<?php

use App\Direccion;
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
        
        $direc = Direccion::create([
            'pais_id' => 1,
            'provincia_id' => 1,
            'localidad_id'=> 1,
            'calle' => 'Los Alpes',
        ]);

        $empresa= Empresa::create([
            'nombre'=>'Barberia Jaime',
            'slug'=>'BARBERIA_JAIME',
            'email'=>'BarbeJaime@gmail.com',
            'telefono'=>'3758520016',
            'cantidadPersonas'=>2,
            'direccion_id' => $direc->id,
        ]);
    }
}
