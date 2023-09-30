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
                'name' => 'users_view',
                'man_name' => 'Просмотр пользователей'
            ],
        ];

        foreach ($params as $param) {
            UsersParam::insert($param);
        }
    }
}
