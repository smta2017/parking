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

        \App\Models\User::factory(5)->create([
            'is_customer' => true
        ]);


        // default Super Admin
        \App\Models\SuperAdmin::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@admin.com',
        ]);


        \App\Models\User::factory(10)->create();
        \App\Models\ParentZone::factory(10)->create();
        \App\Models\Zone::factory(10)->create();
        \App\Models\Transaction::factory(100)->create();
        \App\Models\Tenant::factory(100)->create();
        \App\Models\Admin::factory(10)->create();
        \App\Models\TenantZone::factory(500)->create();


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

        // default Admin
        \App\Models\Admin::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
        ]);

        // default plan
        \DB::statement('ALTER TABLE plans AUTO_INCREMENT = 1;');


        // zone_bucket

        $this->call([
            ZoneBucketSeeder::class,
        ]);
        
        $plan = app('rinvex.subscriptions.plan')->create([
            'name' => ['en' => 'Monthly', 'ar' => 'شهري'],
            'description' => ['en' => 'Monthly plan', 'ar' => 'شهري', 'kd' => 'dsdsd'],
            'price' => 500,
            'signup_fee' => 0,
            'invoice_period' => 1,
            'invoice_interval' => 'month',
            'trial_period' => 0,
            'trial_interval' => 'day',
            'sort_order' => 1,
            'currency' => 'EGP',
        ]);
        $plan = app('rinvex.subscriptions.plan')->create([
            'name' => ['en' => 'Quarterly', 'ar' => 'ربع سنوي'],
            'description' => ['en' => 'Quarterly', 'ar' => 'ربع سنوي'],
            'price' => 1500,
            'signup_fee' => 0,
            'invoice_period' => 3,
            'invoice_interval' => 'month',
            'trial_period' => 0,
            'trial_interval' => 'day',
            'sort_order' => 1,
            'currency' => 'EGP',
        ]);
        $plan = app('rinvex.subscriptions.plan')->create([
            'name' => ['en' => 'Midterm', 'ar' => 'نصف سنوي'],
            'description' => ['en' => 'Midterm plan', 'ar' => 'نصف سنوي'],
            'price' => 3000,
            'signup_fee' => 0,
            'invoice_period' => 6,
            'invoice_interval' => 'month',
            'trial_period' => 0,
            'trial_interval' => 'day',
            'sort_order' => 1,
            'currency' => 'EGP',
        ]);
        $plan = app('rinvex.subscriptions.plan')->create([
            'name' => ['en' => 'annualy', 'ar' => 'سنوي'],
            'description' => ['en' => 'annualy plan', 'ar' => 'سنوي'],
            'price' => 6000,
            'signup_fee' => 0,
            'invoice_period' => 12,
            'invoice_interval' => 'month',
            'trial_period' => 0,
            'trial_interval' => 'day',
            'sort_order' => 1,
            'currency' => 'EGP',
        ]);
    }
}
