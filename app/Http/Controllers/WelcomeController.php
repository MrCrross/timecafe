<?php

namespace App\Http\Controllers;

use App\Modules\Products\Models\Product;
use App\Modules\Rooms\Models\Room;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

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

        $products = Product::selectRaw('
            products.id as value,
            CONCAT(products_types.name, " ", products.name) as label
        ')
            ->join('products_types', 'products_types.id', '=', 'products.type_id')
            ->orderBy('products.name')
            ->get();

        return response()->view('welcome', [
            'rooms' => $rooms,
            'menuLeft' => $previewMenu->forPage(1, 4),
            'menuRight' => $previewMenu->forPage(2, 4),
            'roomsLeft' => $previewRooms->forPage(1, 4),
            'roomsRight' => $previewRooms->forPage(2, 4),
            'products' => $products,
        ]);
    }

    public function admin(): Response
    {
        return response()->view('admin');
    }

    public function rules(): Response
    {
        $content = Storage::exists('/upload/rules.txt') ? Storage::get('/upload/rules.txt') : '';

        return response()->view('rules', ['content' => $content]);
    }

    public function loyalty(): Response
    {
        $content = Storage::exists('/upload/loyalty.txt') ? Storage::get('/upload/loyalty.txt') : '';

        return response()->view('loyalty', ['content' => $content]);
    }
}
