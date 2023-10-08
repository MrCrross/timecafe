<?php

namespace Database\Factories\Modules\Products\Models;

use App\Modules\Products\Models\Product;
use App\Modules\ProductsTypes\Models\ProductsType;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Exception
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->jobTitle(),
            'price' => fake()->randomNumber(),
            'image' => fake()->imageUrl,
            'type_id' => ProductsType::factory(),
        ];
    }
}
