<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\Modules\Products\Models\ProductFactory;
use Database\Factories\Modules\Rooms\Models\RoomsImageFactory;
use Database\Factories\Modules\Rooms\Models\RoomsReservationFactory;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersParamsSeeder::class,
            UsersSeeder::class,
        ]);

        UserFactory::new()->count(10)->create();
        ProductFactory::new()->count(10)->create();
        RoomsImageFactory::new()->count(10)->create();
        RoomsReservationFactory::new()->count(10)->create();

        $this->call([
            OrdersSeeder::class,
        ]);
    }
}
