<?php

namespace App\Modules\Orders\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Orders\Models\Order;
use App\Modules\Orders\Models\OrdersProduct;
use App\Modules\Orders\Requests\OrdersStoreRequest;
use App\Modules\Orders\Requests\OrdersUpdateRequest;
use App\Modules\Products\Models\Product;
use App\Modules\Rooms\Models\Room;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $orders = Order::with('room', 'products')
            ->orderBy('date_order', 'desc')
            ->get();

        return response()->view('orders.index', [
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $rooms = Room::select('id as value', 'name as label')
            ->orderBy('name')
            ->get();
        $products = Product::selectRaw('
            products.id as value,
            CONCAT(products_types.name, " ", products.name) as label
        ')
            ->join('products_types', 'products_types.id', '=', 'products.type_id')
            ->orderBy('products.name')
            ->get();
        return response()->view('orders.create', [
            'rooms' => $rooms,
            'products' => $products,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrdersStoreRequest $request): RedirectResponse
    {
        $fields = [
            'room_id' => $request->post('room_id'),
            'status' => 1,
            'date_order' => Carbon::now()->toDateTime(),
        ];

        $orderID = Order::restore(0, $fields);

        foreach ($request->post('products') as $product) {
            $orderProductFields = [
                'order_id' => $orderID,
                'product_id' => $product['id'],
                'count' => $product['count'],
            ];
            OrdersProduct::restore(0, $orderProductFields);
        }

        return Redirect::route('orders.create')->with('status', 'order-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): Response
    {
        $order = Order::selectRaw('orders.*, IF(status = 1, "Выполняется", IF(status = 2, "Выполнен", "Удален")) as status_name')
            ->with('room')
            ->find($id);

        return response()->view('orders.show', [
            'order' => $order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): Response
    {
        $order = Order::with('room', 'products')
            ->find($id);
        $rooms = Room::select('id as value', 'name as label')
            ->orderBy('name')
            ->get();
        $products = Product::selectRaw('
            products.id as value,
            CONCAT(products_types.name, " ", products.name) as label
        ')
            ->join('products_types', 'products_types.id', '=', 'products.type_id')
            ->orderBy('products.name')
            ->get();
        return response()->view('orders.edit', [
            'order' => $order,
            'rooms' => $rooms,
            'products' => $products,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrdersUpdateRequest $request, string $id): RedirectResponse
    {
        $fields = [
            'status' => $request->post('status'),
        ];

        if ($request->has('room_id')) {
            $fields['room_id'] = $request->post('room_id');
        }

        Order::restore($id, $fields);

        if ($request->has('products')) {
            $currentProducts = OrdersProduct::query()->select('id', 'product_id')
                ->where('order_id', '=', $id)
                ->pluck('id', 'product_id')
                ->toArray();
            foreach ($request->post('products') as $product) {
                $orderProductID = 0;
                $orderProductFields = [
                    'order_id' => $id,
                    'product_id' => $product['id'],
                    'count' => $product['count'],
                ];
                if (!empty($currentProducts[$product['id']])) {
                    $orderProductID = $currentProducts[$product['id']];
                }

                OrdersProduct::restore($orderProductID, $orderProductFields);
            }
        }

        return Redirect::route('orders.edit', $id)->with('status', 'order-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        OrdersProduct::deleteByOrderID($id);
        Order::deleteByID($id);

        return redirect()->route('orders.index');
    }
}
