<?php

namespace Database\Factories\Modules\Stocks\Models;

use App\Modules\Products\Models\Product;
use App\Modules\Stocks\Models\Stock;
use Carbon\Carbon;
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
            'product_id' => Product::all()->random()->id,
            'description' => fake()->text,
            'expired_date' => Carbon::now()->addDay()->toDateTimeString(),
            'price' => fake()->numberBetween(100, 1000),
        ];
    }
}
