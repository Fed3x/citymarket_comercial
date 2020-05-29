<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [
        'name', 'email', 'password',
    ];

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



    public function getCreatedAtAttribute($date) {
        return Carbon::parse($date)->setTimezone('America/Asuncion')->format('d/m/Y H:i:s');
    }

    public function isAdministrador(){
        if ($this->perfil->descripcion == 'Administrador') {
            return true;
        }
        return false;
    }



    public function perfil()
    {
        return $this->belongsTo('App\Perfil', 'id_perfil');
    }
}
