<?php

namespace Database\Factories\Modules\Rooms\Models;

use App\Modules\Rooms\Models\Room;
use App\Modules\Rooms\Models\RoomsRate;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Room>
 */
class RoomFactory extends Factory
{
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Exception
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word,
            'image' => fake()->imageUrl,
            'rate_id' => RoomsRate::factory(),
            'capacity' => random_int(1, 10),
        ];
    }
}
