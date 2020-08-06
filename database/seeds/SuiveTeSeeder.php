<?php

use Illuminate\Database\Seeder;

class SuiveTeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\SuiveTe', 2000)->create();
    }
}
