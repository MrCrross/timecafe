<?php

namespace Database\Seeders;

use App\Modules\Orders\Models\Order;
use App\Modules\Orders\Models\OrdersProduct;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class OrdersSeeder extends Seeder
{
    public function run(): void
    {
        $orders = [
            [
                'room_id' => 1,
                'status' => 1,
                'date_order' => Carbon::now()->subDays(rand(0, 5))->toDateTimeString(),
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
                'date_order' => Carbon::now()->subDays(rand(0, 5))->toDateTimeString(),
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
                'date_order' => Carbon::now()->subDays(rand(0, 5))->toDateTimeString(),
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
            Order::insert($order);
            OrdersProduct::insert($products);
        }
    }
}
