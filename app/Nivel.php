<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dim_nivel_productos';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    public function estructuras()
    {
        return $this->hasMany('App\Estructura', 'id_nivel', 'id');
    }
}
