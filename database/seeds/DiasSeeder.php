<?php

use App\Dia;
use Illuminate\Database\Seeder;

class DiasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dia::create([
            'id'  => 1 ,
            'dia' => 'Lunes'
        ]);
        Dia::create([
            'id'  => 2 ,
            'dia' => 'Martes'
        ]);
        Dia::create([
            'id'  => 3,
            'dia' => 'Miercoles'
        ]);
        Dia::create([
            'id'  => 4,
            'dia' => 'Jueves'
        ]);
        Dia::create([
            'id'  => 5,
            'dia' => 'Viernes'
        ]);
        Dia::create([
            'id'  => 6,
            'dia' => 'Sabado'
        ]);
        Dia::create([
            'id'  => 0,
            'dia' => 'Domingo'
        ]);
    }
}
