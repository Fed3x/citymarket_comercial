<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'perfiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['descripcion'];


    public function departamento()
    {
        return $this->belongsTo('App\Departamento', 'id_departamento');
    }

    public function users()
    {
        return $this->hasMany('App\Users', 'id_perfil');
    }

}
