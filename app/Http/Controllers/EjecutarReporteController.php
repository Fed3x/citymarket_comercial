<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Illuminate\Support\Str;
use App\TrabajoEjecutado;
use Carbon\Carbon;

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

        for ($i=1; $i < count($request->correos); $i++) { 
            $correos = $correos . ' ' . $request->correos[$i];
        }

        $trabajo_ejecutado = New TrabajoEjecutado();
        $trabajo_ejecutado->id_trabajo = $id_trabajo;
        $trabajo_ejecutado->serial = $random;
        $trabajo_ejecutado->created_by = 'admin';
        $trabajo_ejecutado->created_at = Carbon::now();
        $trabajo_ejecutado->save();



        $command = "~/.composer/vendor/bin/envoy run foo --fecha_i='$fecha_inicio 00:00:00' --fecha_f='$fecha_final 23:59:59' --area_trabajo='$area_trabajo' --trabajo='$trabajo' --serial='$random' --correos='$correos'";
        
        $directory = base_path();

        $process = Process::fromShellCommandline($command);
        $process->setTimeout(3600);
        $process->setIdleTimeout(300);
        $process->setWorkingDirectory($directory);
        try {
            $process->mustRun();
            echo $process->getOutput();
        } catch (ProcessFailedException $e) {
            echo $e->getMessage();
        }

        
    }
}

