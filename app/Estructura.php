<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estructura extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tdh_estructura';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_producto','id_nivel','dias_stock','stock_minimo','micropicking'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function producto()
    {
        return $this->belongsTo('App\Producto', 'id_producto', 'identificador');
    }

    public function nivel()
    {
        return $this->belongsTo('App\Nivel', 'id_nivel', 'id');
    }
}
