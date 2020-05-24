<?php

namespace App;

use Caffeinated\Shinobi\Concerns\HasRolesAndPermissions;
use Caffeinated\Shinobi\Models\Role;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;
    use HasRolesAndPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'apellido'
    ];

    // protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    //si es un empleado pertenece a una empresa
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
    // empresas a la que esta suscripta el usuario
    public function suscripciones()
    {
        return $this->hasMany(Suscripcion::class);
    }

    public function empresaSuscriptas()
    {
        return $this->belongsToMany(Empresa::class, 'suscripciones', 'user_id', 'empresa_id');
    }

    public function getFecha()
    {
        $date = Carbon::create($this->fecha_nacimiento)->format('d/m/Y');
        return $date;
    }

    public function getEdad()
    {
        $date = Carbon::create($this->fecha_nacimiento);
        return $date->age;
    }

    public function turnos()
    {
        return $this->hasMany(Turno::class);
    }
}
