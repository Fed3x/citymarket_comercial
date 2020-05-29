<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Producto;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return $productos;
    }

    public function sinestructura(){
        // $consulta = Producto::doesntHave('estructura', function($consulta){
        //     $consulta->where('estado', '<>','DI');
        // })->get();

        // $consulta = Producto::doesntHave('estructura')->get();
        // $productos = $consulta->each(function ($item, $key) {
        //     if ($item->estado <> 'DI') {
        //         return $item;
        //     }
        // });
        // $productos = $consulta->each(function ($item, $key) {
        //     if ($item->estado <> 'DI') {
        //         return true;
        //     }
        // });
        $consulta = Producto::whereDoesntHave('estructura')->get();
        $productos = array();

        foreach($consulta as $producto){
            if($producto->estado <> "DI"){
                array_push($productos, $producto);
            }
        }

        return $productos;


    }
}

