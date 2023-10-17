<?php

namespace Database\Factories\Modules\Rooms\Models;

use App\Modules\Rooms\Models\Room;
use App\Modules\Rooms\Models\RoomsReservation;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<RoomsReservation>
 */
class RoomsReservationFactory extends Factory
{
    protected $model = RoomsReservation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Exception
     */
    public function definition(): array
    {
        return [
            'room_id' => Room::factory(),
            'fio' => fake()->name,
            'email' => fake()->email,
            'hours' => random_int(1, 5),
            'capacity' => random_int(1, 5),
            'date_reserve' => fake()->dateTime,
        ];
    }
}
