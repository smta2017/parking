<?php

namespace Database\Factories;

use App\Models\CustomerVehicle;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerVehicleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomerVehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => User::pluck('id')->random(),
            'plate_number' => $this->faker->word,
            'vehicle_color' => $this->faker->word,
            'vehicle_brand' => $this->faker->word,
            'vehicle_model' => $this->faker->word,
            'vehicle_model_year' => $this->faker->word,
            'vehicle_type' => "sidan",
            'slot' => $this->faker->numberBetween(1, 10),
            'license_number' => $this->faker->word,
            'license_expiration' => $this->faker->date('Y-m-d H:i:s'),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
