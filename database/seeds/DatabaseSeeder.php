<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(DepartamentoSeeder::class);
        // $this->call(PerfilSeeder::class);
        // $this->call(UserSeeder::class);
        $this->call('ParametroSeeder');
    }
}
