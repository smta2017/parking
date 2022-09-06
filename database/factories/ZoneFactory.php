<?php

namespace Database\Factories;

use App\Models\ParentZone;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;

class ZoneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Zone::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'address' => $this->faker->address,
            'manager' => $this->faker->word,
            'phone' => $this->faker->word,
            'capacity' => $this->faker->numberBetween(10,50),
            'hour_rate' => $this->faker->numberBetween(5,10),
            'parent_zone_id' =>ParentZone::pluck('id')->random(),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
