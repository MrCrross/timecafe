<?php

namespace Database\Factories\Modules\Rooms\Models;

use App\Modules\Rooms\Models\RoomsRate;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<RoomsRate>
 */
class RoomsRateFactory extends Factory
{
    protected $model = RoomsRate::class;

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
            'price' => random_int(100, 1000),
        ];
    }
}
