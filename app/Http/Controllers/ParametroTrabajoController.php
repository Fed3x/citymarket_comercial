<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parametro;
use App\Trabajo;
use Carbon\Carbon;
use Auth;

class ParametroTrabajoController extends Controller
{
    public function index()
    {

        $trabajos = Trabajo::has('parametros')->with('parametros')->orderBy('descripcion')->get();
        $parametros = Parametro::orderBy('created_at', 'asc')->where('estado', true)->get();
        $trabajos_sin_p  = Trabajo::doesntHave('parametros')->get();

        return ['trabajos'=>$trabajos, 'parametros' => $parametros, 'trabajos_sin_p' => $trabajos_sin_p];
    }

    public function store(Request $request)
    {
        $trabajo = Trabajo::find($request->trabajo_id);
        $trabajo->parametros()->attach($request->parametros, ['created_by'=> Auth::user()->name]);
        $trabajo->load('parametros');
        $trabajos_sin_p  = Trabajo::doesntHave('parametros')->get();

        return ['trabajo'=> $trabajo, 'trabajos_sin_p' => $trabajos_sin_p];
    }

    public function update(Request $request, $id)
    {
        $actual = [];
        $attach = [];
        $detach = [];

        $trabajo_actual = Trabajo::where('id', $id)->with('parametros')->first();
        foreach($trabajo_actual->parametros as $parametro){
            array_push($actual, $parametro->id);
        }
        $attach  =  array_diff($request->parametros, $actual);
        $detach  =  array_diff($actual, $request->parametros);

        $trabajo = Trabajo::find($id);
        $trabajo->parametros()->attach($attach, ['created_by'=> Auth::user()->name]);
        $trabajo->parametros()->detach($detach);

        $trabajo->load('parametros');

        return ['trabajo' => $trabajo, 'index' => $request->index];

    }

    public function destroy($id)
    {
        $trabajo = Trabajo::find($id);
        $trabajo->parametros()->detach();
        $trabajos_sin_p  = Trabajo::doesntHave('parametros')->get();

        return ['trabajos_sin_p' => $trabajos_sin_p];

    }
}
