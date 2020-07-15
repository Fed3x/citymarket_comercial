<?php

namespace App\Jobs;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerarReporte implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $fecha_inicio;
    protected $fecha_final;
    protected $area_trabajo;
    protected $trabajo;
    protected $random;
    protected $correos;

    public function __construct($fecha_inicio, $fecha_final, $area_trabajo, $trabajo, $random, $correos)
    {
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_final = $fecha_final;
        $this->area_trabajo = $area_trabajo;
        $this->trabajo = $trabajo;
        $this->random = $random;
        $this->correos = $correos;
    }


    public function handle()
    {
        $command = "envoy run foo --fecha_i='$this->fecha_inicio 00:00:00' --fecha_f='$this->fecha_final 23:59:59' --area_trabajo='$this->area_trabajo' --trabajo='$this->trabajo' --serial='$this->random' --correos='$this->correos'";
        $directory = base_path();
        $process = Process::fromShellCommandline($command);
        $process->setTimeout(1800);
        $process->run();
    }
}