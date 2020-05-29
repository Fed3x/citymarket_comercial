<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public function departamentos()
    {
        return $this->belongsToMany('App\Departamento', 'departamentos_trabajos', 'id_trabajo', 'id_departamento')->withTimestamps();
    }

    public function getCreatedAtAttribute($date) {
        return Carbon::parse($date)->setTimezone('America/Asuncion')->format('d/m/Y H:i:s');
    }
}
