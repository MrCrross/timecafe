<?php

namespace Database\Factories\Rooms;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rooms\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws \Exception
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word,
            'rate_id' => random_int(1, 10),
            'capacity' => random_int(1, 10),
        ];
    }
}
