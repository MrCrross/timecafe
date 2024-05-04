<?php

namespace Database\Factories\Modules\Reviews\Models;

use App\Modules\Reviews\Models\Review;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Exception
     */
    public function definition(): array
    {
        return [
            'user_id' => random_int(1,10),
            'rating' => random_int(0,5),
            'content' => fake()->text,
        ];
    }
}
