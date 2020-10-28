<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'fbaez',
            'email' => 'fbaez@tifretail.com',
            'password' => '$2y$10$aFGv1PSFtk.gNu5nu9clQ.D/gjaFLEkPtFf4MttWmJ30pu2MbVUCK',
            'created_at' => Carbon::now(),
            'estado' =>  true,
        ]);
    }
}
