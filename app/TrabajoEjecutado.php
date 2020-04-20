<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrabajoEjecutado extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pdi_trabajos_ejecutados';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_trabajo','serial', 'confirmed', 'created_by','updated_by'];

    public function trabajo()
    {
        return $this->belongsTo('App\Trabajo', 'id_trabajo');
    }
}
