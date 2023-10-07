<?php

namespace Database\Seeders;

use App\Models\UsersParam;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersParamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $params = [
            [
                'name' => 'products_view',
                'man_name' => 'Просмотр товаров'
            ],
            [
                'name' => 'products_edit',
                'man_name' => 'Правки товаров'
            ],
            [
                'name' => 'products_types_view',
                'man_name' => 'Просмотр типов товаров'
            ],
            [
                'name' => 'products_types_edit',
                'man_name' => 'Правки типы товаров'
            ],
            [
                'name' => 'rooms_view',
                'man_name' => 'Просмотр комнат'
            ],
            [
                'name' => 'rooms_edit',
                'man_name' => 'Правки комнат'
            ],
            [
                'name' => 'users_view',
                'man_name' => 'Просмотр пользователей'
            ],
            [
                'name' => 'users_edit',
                'man_name' => 'Создание учетных записей'
            ],
            [
                'name' => 'rates_edit',
                'man_name' => 'Правки тарифов'
            ],
            [
                'name' => 'orders_view',
                'man_name' => 'Просмотр заказов'
            ],
            [
                'name' => 'orders_edit',
                'man_name' => 'Работа с заказами'
            ],
        ];

        foreach ($params as $param) {
            UsersParam::insert($param);
        }
    }
}
