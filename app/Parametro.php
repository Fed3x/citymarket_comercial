<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
    protected $table = 'pdi_parametros';


    protected $fillable = ['descripcion','estado', 'created_by'];


    public function trabajos()
    {
        return $this->belongsToMany('App\Trabajo', 'pdi_trabajos_parametros', 'id_parametro', 'id_trabajo');
    }
}
