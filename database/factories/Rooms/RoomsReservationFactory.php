<?php

namespace Database\Factories\Rooms;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RoomsReservationFactory extends Factory
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
            'room_id' => random_int(1, 10),
            'user_id' => null,
            'fio' => fake()->name,
            'status' => random_int(0, 1),
            'hours' => random_int(1, 5),
            'capacity' => random_int(1, 5),
            'date_reserve' => fake()->dateTime,
        ];
    }
}
