<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;

class RolSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name'          => 'ADMIN',
            'slug'          => 'admin',
            'description'    => 'puede hacer de todo' ,
            'special'       => 'all-access' ,
        ]);
    }
}
