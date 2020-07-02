<?php

namespace App\Http\Controllers;
use App\Jobs\GenerarReporte;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\TrabajoEjecutado;
use Carbon\Carbon;
use Auth;


class EjecutarReporteController extends Controller
{
    protected function ejecutar(Request $request)
    {

        $fecha_inicio = Carbon::create($request->fecha_inicio)->format('d/m/Y');
        $fecha_final = Carbon::create($request->fecha_final)->format('d/m/Y');
        $area_trabajo = $request->area_trabajo;
        $trabajo = $request->trabajo;
        $id_trabajo = $request->id_trabajo;
        $random = Str::random(32);
        $correos = $request->correos[0];

        if (count($request->correos) > 1){
            for ($i=1; $i < count($request->correos); $i++) { 
                $correos = $correos . ' ' . $request->correos[$i];
            }
        }
        
        $trabajo_ejecutado = New TrabajoEjecutado();
        $trabajo_ejecutado->id_trabajo = $id_trabajo;
        $trabajo_ejecutado->serial = $random;
        $trabajo_ejecutado->created_by = Auth::user()->name;
        $trabajo_ejecutado->created_at = Carbon::now();
        $trabajo_ejecutado->save();
        $job = new GenerarReporte($fecha_inicio, $fecha_final, $area_trabajo, $trabajo, $random, $correos);
        dispatch($job);
    }
}

