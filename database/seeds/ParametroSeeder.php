<?php

use Illuminate\Database\Seeder;
use App\Parametro;
use Carbon\Carbon;

class ParametroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parametros = [
            [
                'descripcion' => 'FECHAS',
                'created_at' => Carbon::now(),
                'estado' =>  true
            ],
            [
                'descripcion' => 'PRODUCTOS',
                'created_at' => Carbon::now(),
                'estado' =>  true
            ],
            [
                'descripcion' => 'SUCURSALES',
                'created_at' => Carbon::now(),
                'estado' =>  true
            ]
        ];
        foreach($parametros as $parametro){
            Parametro::create($parametro);
        }
    }
}
