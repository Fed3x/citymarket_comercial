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
        $trabajo = $request[0];
        $parametros = $request[1];
        $area_trabajo = $request[0]["area_trabajo"];
        $trabajo = $request[0]["trabajo"];
        $id_trabajo = $request[0]["id_trabajo"];
        $random = Str::random(32);
        $correos = $request[0]["correos"][0];
        if (count($request[0]["correos"]) > 1){
            for ($i=1; $i < count($request[0]["correos"]) ; $i++) { 
                $correos = $correos . ' ' . $request[0]["correos"][$i];
            }
        }
        if($request[1]["fechas"]){
            $fecha_inicio = Carbon::create($request[0]["fecha_i"])->format('d/m/Y');
            $fecha_final = Carbon::create($request[0]["fecha_f"])->format('d/m/Y');
        }else{
            $fecha_inicio = '';
            $fecha_final = '';
        }
        if($request[1]["productos"]){
            $productos = $request[0]["productos"][0];
            if(count($request[0]["productos"]) > 1){
                for ($i=1; $i < count($request[0]["productos"]); $i++){
                    $productos = $productos . ',' . $request[0]["productos"][$i];
                }
            }
        }else{
            $productos = '';
        }
        $trabajo_ejecutado = New TrabajoEjecutado();
        $trabajo_ejecutado->id_trabajo = $id_trabajo;
        $trabajo_ejecutado->serial = $random;
        $trabajo_ejecutado->created_by = Auth::user()->name;
        $trabajo_ejecutado->created_at = Carbon::now();
        $trabajo_ejecutado->save();
        $job = new GenerarReporte($fecha_inicio, $fecha_final, $area_trabajo, $trabajo, $random, $correos, $productos);
        dispatch($job);
    }
}

