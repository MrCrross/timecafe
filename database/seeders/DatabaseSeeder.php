<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Products\Product;
use App\Models\Products\ProductsType;
use App\Models\Rooms\Room;
use App\Models\Rooms\RoomsImage;
use App\Models\Rooms\RoomsOrder;
use App\Models\Rooms\RoomsOrdersProduct;
use App\Models\Rooms\RoomsRate;
use App\Models\Rooms\RoomsReservation;
use App\Models\User;
use Database\Factories\Rooms\RoomsRateFactory;
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

        User::factory(10)->create();
        ProductsType::factory(10)->create();
        Product::factory(10)->create();

        RoomsRate::factory(10)->create();
        Room::factory(10)->create();
        RoomsImage::factory(10)->create();
        RoomsReservation::factory(10)->create();

        $this->call([
            RoomsOrdersSeeder::class,
        ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
