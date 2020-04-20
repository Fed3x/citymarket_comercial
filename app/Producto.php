<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dim_productos';

    public function estructura()
    {
        return $this->hasOne('App\Estructura', 'id_producto', 'identificador');
    }
}
