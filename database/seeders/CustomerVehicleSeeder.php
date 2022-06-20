<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomerVehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\CustomerVehicle::factory(10)->create();
        
    }
}
