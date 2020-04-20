<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return $productos;
    }

    public function sinestructura(){
        $consulta = Producto::doesntHave('estructura')->get();
        $productos =  $consulta->where('estado', '<>','DI');
        return $productos;
    }
}
