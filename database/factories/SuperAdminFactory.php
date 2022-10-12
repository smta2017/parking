<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SuperAdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->unique()->e164PhoneNumber,
            'national_id' => $this->faker->numberBetween(10018765465468, 30018765465468),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Str::random(10),
            'job_title' => $this->faker->jobTitle,
            'edu' => $this->faker->jobTitle,
            'dob' => $this->faker->date,
            'gender' => $this->faker->randomElement(['mail', 'femail'])
        ];
    }
}