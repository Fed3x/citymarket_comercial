<?php

use Illuminate\Database\Seeder;
use App\Departamento;
use Carbon\Carbon;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Departamento::create([
            'descripcion' => 'Tecnologia de la Informacion',
            'abreviatura' => 'TI',
            'estado' =>  true,
            'created_at' => Carbon::now(),
            'created_by' => 'fbaez'
        ]);
    }
}
