<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ZoneBucketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ZoneBucket::factory(100)->create();
    }
}
