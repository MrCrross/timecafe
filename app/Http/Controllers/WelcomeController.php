<?php

namespace App\Http\Controllers;

use App\Modules\Products\Models\Product;
use App\Modules\Rooms\Models\Room;
use Illuminate\Http\Response;

class WelcomeController extends Controller
{
    public function get(): Response
    {
        $previewMenu = Product::with('type')
            ->orderBy('name')
            ->orderBy('type_id')
            ->limit(8)
            ->get();

        $previewRooms = Room::query()
            ->orderBy('name')
            ->limit(8)
            ->get();

        $rooms = Room::with('rate')
            ->orderBy('name')
            ->get();

        return response()->view('welcome', [
            'rooms' => $rooms,
            'menuLeft' => $previewMenu->forPage(1, 4),
            'menuRight' => $previewMenu->forPage(2, 4),
            'roomsLeft' => $previewRooms->forPage(1, 4),
            'roomsRight' => $previewRooms->forPage(2, 4),
        ]);
    }

    public function admin(): Response
    {
        return response()->view('admin');
    }
}
