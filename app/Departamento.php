<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'departamentos';


    protected $fillable = ['descripcion','abreviatura','estado'];


    public function trabajos()
    {
        return $this->belongsToMany('App\Trabajo', 'departamentos_trabajos', 'id_departamento', 'id_trabajo');
    }
    
    public function perfiles()
    {
        return $this->hasMany('App\Perfil', 'id_departamento');
    }
}
    