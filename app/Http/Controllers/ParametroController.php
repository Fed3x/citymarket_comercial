<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Parametro;
use Auth;

class ParametroController extends Controller
{
    public function index()
    {
        $parametros = Parametro::orderBy('created_at','asc')->paginate(15);
        return $parametros;
    }

    public function store(Request $request)
    {
        $parametro = New Parametro();
        $parametro->descripcion = $request->descripcion;
        $parametro->abreviatura = $request->abreviatura;
        $parametro->estado = true;
        $parametro->created_by =  Auth::user()->name;
        $parametro->created_at = Carbon::now();
        $parametro->save();
        
        return $parametro;
    }
    public function update(Request $request, $id)
    {
        $parametro = Parametro::find($id);
        $parametro->descripcion = $request->descripcion;
        $parametro->abreviatura = $request->abreviatura;
        $parametro->estado = $request->estado;
        $parametro->updated_by =  Auth::user()->name;
        $parametro->updated_at = Carbon::now();
        $parametro->save();

        return ['parametro' => $parametro, 'index' => $request->index ];
    }

    public function destroy($id)
    {
        $parametro = parametro::find($id);
        $parametro->delete();
    }
}