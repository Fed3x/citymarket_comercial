<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Trabajo;
use App\Departamento;
use Auth;

use Illuminate\Http\Request;

class DepartamentoTrabajoController extends Controller
{

    public function index()
    {

        $trabajos = Trabajo::has('departamentos')->with('departamentos')->orderBy('descripcion')->get();
        $departamentos = Departamento::orderBy('created_at', 'asc')->where('estado', true)->get();
        $trabajos_sin_d  = Trabajo::doesntHave('departamentos')->get();

        return ['trabajos'=>$trabajos, 'departamentos' => $departamentos, 'trabajos_sin_d' => $trabajos_sin_d];
    }

    public function store(Request $request)
    {
        $trabajo = Trabajo::find($request->trabajo_id);
        $trabajo->departamentos()->attach($request->departamentos, ['created_by'=> Auth::user()->name]);
        $trabajo->load('departamentos');
        $trabajos_sin_d  = Trabajo::doesntHave('departamentos')->get();

        return ['trabajo'=> $trabajo, 'trabajos_sin_d' => $trabajos_sin_d];
    }

    public function show($id)
    {



    }

    public function update(Request $request, $id)
    {
        $actual = [];
        $attach = [];
        $detach = [];

        $trabajo_actual = Trabajo::where('id', $id)->with('departamentos')->first();
        foreach($trabajo_actual->departamentos as $departamento){
            array_push($actual, $departamento->id);
        }
        $attach  =  array_diff($request->departamentos, $actual);
        $detach  =  array_diff($actual, $request->departamentos);

        $trabajo = Trabajo::find($id);
        $trabajo->departamentos()->attach($attach, ['created_by'=> Auth::user()->name]);
        $trabajo->departamentos()->detach($detach);

        $trabajo->load('departamentos');

        return ['trabajo' => $trabajo, 'index' => $request->index];



    }

    public function destroy($id)
    {
        $trabajo = Trabajo::find($id);
        $trabajo->departamentos()->detach();
        $trabajos_sin_d  = Trabajo::doesntHave('departamentos')->get();

        return ['trabajos_sin_d' => $trabajos_sin_d];

    }
}
