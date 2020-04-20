<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pdi_trabajos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['descripcion','area_trabajo','trabajo'];

    public function trabajos_ejecutados()
    {
        return $this->hasMany('App\TrabajoEjecutado', 'id_trabajo');
    }
}
