<?php

namespace Database\Seeders;

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
        \App\Models\Zone::factory()->create([
            'name' => 'الفلكي',
            'hour_rate' => 10,
            'capacity' => 70,
        ]);

        \App\Models\User::factory(10)->create();
        \App\Models\Zone::factory(10)->create();
        \App\Models\Transaction::factory(100)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@admin.com',
            'zone_id' => 1
        ]);
    }
}
