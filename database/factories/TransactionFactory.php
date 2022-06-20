<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'plate_number' => $this->faker->numberBetween(111, 999) . ' - ' . Str::random(4),
            'plate_img' => 'default.jpeg',
            'out_at' => $this->faker->date('Y-m-d H:i:s'),//$this->faker->randomElement([$this->faker->dateTimeBetween($startDate = '0 days', $endDate = '2 hours', $timezone = null), null]),
            'qr_code' => $this->faker->randomDigitNotNull,
            'is_payed' => $this->faker->randomDigitNotNull,
            'zone_id' => $this->faker->numberBetween(1, 10),
            'created_by' => $this->faker->numberBetween(1, 10),
            'created_at' => $this->faker->dateTimeBetween($startDate = '-9 days', $endDate = '2 hours', $timezone = null),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
