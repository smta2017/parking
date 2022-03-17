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
            'mobile' => $this->faker->word,
            'driver_name' => $this->faker->word,
            'out_at' => $this->faker->word,
            'qr_code' => $this->faker->word,
            'is_bayed' => $this->faker->word,
            'created_by' => $this->faker->randomDigitNotNull,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
            ];
    }
}
