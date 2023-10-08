<?php

namespace Database\Factories\Modules\ProductsTypes\Models;

use App\Modules\ProductsTypes\Models\ProductsType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProductsType>
 */
class ProductsTypeFactory extends Factory
{
    protected $model = ProductsType::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'image' => fake()->imageUrl,
        ];
    }
}
