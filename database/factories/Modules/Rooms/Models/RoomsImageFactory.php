<?php

namespace Database\Factories\Modules\Rooms\Models;

use App\Modules\Rooms\Models\Room;
use App\Modules\Rooms\Models\RoomsImage;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<RoomsImage>
 */
class RoomsImageFactory extends Factory
{
    protected $model = RoomsImage::class;

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
            'image' => fake()->imageUrl,
        ];
    }
}
