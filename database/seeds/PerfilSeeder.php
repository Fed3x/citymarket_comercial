<?php

use Illuminate\Database\Seeder;
use App\Perfil;
use Carbon\Carbon;

class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Perfil::create([
            'descripcion' => 'Administrador',
            'id_departamento' => 1,
            'created_at' => Carbon::now(),
            'estado' =>  true,
            'created_by' => 'fbaez'
        ]);
    }
}
