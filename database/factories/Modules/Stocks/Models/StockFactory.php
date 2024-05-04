<?php

namespace Database\Factories\Modules\Stocks\Models;

use App\Modules\Stocks\Models\Stock;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockFactory extends Factory
{
    protected $model = Stock::class;

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
            'description' => fake()->text,
        ];
    }
}
