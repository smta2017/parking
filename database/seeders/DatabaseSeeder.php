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
        //default zone
        \App\Models\Zone::factory()->create([
            'name' => 'الفلكي',
            'hour_rate' => 10,
            'second_hour_rate' => 5,
            'capacity' => 70,
        ]);

        \App\Models\Zone::factory()->create([
            'name' => 'المنتزة',
            'hour_rate' => 10,
            'second_hour_rate' => 5,
            'capacity' => 100,
        ]);

        // default user
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@admin.com',
            'zone_id' => 1
        ]);

        //default customer
        \App\Models\User::factory()->create([
            'name' => 'General Client',
            'email' => 'general@client.com',
            'is_customer' => true
        ]);

          // default Admin
          \App\Models\Admin::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'zone_id' => 1
        ]);


        \App\Models\User::factory(10)->create();
        \App\Models\Zone::factory(10)->create();
        \App\Models\Transaction::factory(100)->create();



        // default plan
        \DB::statement('ALTER TABLE plans AUTO_INCREMENT = 1;');

        $plan = app('rinvex.subscriptions.plan')->create([
            'name' => ['en' => 'Default', 'ar' => 'افتراضي'],
            'description' => ['en' => 'Default plan', 'ar' => 'افتراضي'],
            'price' => 500,
            'signup_fee' => 0,
            'invoice_period' => 1,
            'invoice_interval' => 'month',
            'trial_period' => 0,
            'trial_interval' => 'day',
            'sort_order' => 1,
            'currency' => 'EGP',
        ]);
    }
}
