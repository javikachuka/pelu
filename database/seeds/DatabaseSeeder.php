<?php

use Cardumen\ArgentinaProvinciasLocalidades\Commands\CargarProvinciasLocalidades;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('provincias-localidades:cargar');
        $this->call([
            DiasSeeder::class,
            RolSeed::class,
            EmpresaSeed::class,
            UserSeed::class,
            RubroSeed::class
        ]);
    }
}
