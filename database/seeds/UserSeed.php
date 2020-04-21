<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User() ;
        $user->name = 'admin' ;
        $user->apellido = 'admin' ;
        $user->dni = '00.000.000' ;
        $user->fecha_nacimiento = new DateTime('now') ;
        $user->email = 'admin@admin.com' ;
        $user->password = Hash::make('123') ;
        $user->save() ;
        $user->roles()->sync(1);
    }
}
