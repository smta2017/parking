<?php

namespace Database\Factories;

use App\Models\ZoneBucket;
use Illuminate\Database\Eloquent\Factories\Factory;

class ZoneBucketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ZoneBucket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'zone_id' => $this->faker->randomDigitNotNull,
        'name' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
