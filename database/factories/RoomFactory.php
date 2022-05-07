<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoomModel>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'building_id' => $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
            'name' => $this->faker->name,
            'floor' => $this->faker->randomDigitNotNull,
            'purpose_id' => $this->faker->randomElement([1, 2, 3]),
            'benchmark_price' => $this->faker->randomFloat(2, 0, 100),
            'store_price' => $this->faker->randomFloat(2, 0, 100),
            'area' => $this->faker->randomNumber($nbDigits = 2, $strict = true),
            'move_out_date' => $this->faker->unixTime($max = 'now'),
            'project_id' => $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]),
            'order' => 1
        ];
    }
}
