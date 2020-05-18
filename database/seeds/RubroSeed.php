<?php

use App\Rubro;
use Illuminate\Database\Seeder;

class RubroSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rubro::create([
            'nombre' => 'peluqueria',
            'descripcion' => 'los mejores cortes'
        ]);
    }
}
