<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProductionSeeder::class);

        // Example of how to call a seeder script for a given environment.
        if( App::environment() === 'development' )
        {
            $this->call(DevelopmentSeeder::class);
        }

    }
}
