<?php

namespace Database\Seeders;

use App\Modules\RoomsOrders\Models\RoomsOrder;
use App\Modules\RoomsOrders\Models\RoomsOrdersProduct;
use Illuminate\Database\Seeder;

class RoomsOrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = [
            [
                'room_id' => 1,
                'status' => 1,
                'date_order' => fake()->dateTime,
                'products' => [
                    [
                        'order_id' => 1,
                        'product_id' => 1,
                        'count' => 2,
                    ],
                    [
                        'order_id' => 1,
                        'product_id' => 2,
                        'count' => 3,
                    ],
                    [
                        'order_id' => 1,
                        'product_id' => 3,
                        'count' => 1,
                    ],
                ],
            ],
            [
                'room_id' => 2,
                'status' => 1,
                'date_order' => fake()->dateTime,
                'products' => [
                    [
                        'order_id' => 2,
                        'product_id' => 1,
                        'count' => 2,
                    ],
                    [
                        'order_id' => 2,
                        'product_id' => 2,
                        'count' => 3,
                    ],
                    [
                        'order_id' => 2,
                        'product_id' => 3,
                        'count' => 1,
                    ],
                ],
            ],
            [
                'room_id' => 3,
                'status' => 1,
                'date_order' => fake()->dateTime,
                'products' => [
                    [
                        'order_id' => 3,
                        'product_id' => 1,
                        'count' => 2,
                    ],
                    [
                        'order_id' => 3,
                        'product_id' => 2,
                        'count' => 3,
                    ],
                    [
                        'order_id' => 3,
                        'product_id' => 3,
                        'count' => 1,
                    ],
                ],
            ],
        ];

        foreach ($orders as $order) {
            $products = $order['products'];
            unset($order['products']);
            RoomsOrder::insert($order);
            RoomsOrdersProduct::insert($products);
        }
    }
}
