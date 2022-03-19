<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'plate_number' => $this->faker->word,
            'plate_img' => $this->faker->word,
            'mobile' => $this->faker->phoneNumber,
            'driver_name' => $this->faker->name(),
            'out_at' => $this->faker->date('Y-m-d H:i:s'),
            'qr_code' => $this->faker->randomDigitNotNull,
            'is_bayed' => $this->faker->randomDigitNotNull,
            'created_by' => $this->faker->unique()->numberBetween(1,10),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
