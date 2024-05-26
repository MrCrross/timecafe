<?php

namespace App\Http\Controllers;

use App\Modules\Orders\Models\Order;
use App\Modules\Orders\Models\OrdersProduct;
use App\Modules\Rooms\Models\RoomsReservation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;

class ReservationController extends Controller
{
    public function index(): Response
    {
        $reservations = RoomsReservation::with('room')
            ->orderBy('date_reserve', 'desc')
            ->get();

        foreach ($reservations as $reservation) {
            $reservation->order = Order::query()
                ->with('products.product')
                ->where('room_id', '=', $reservation->room_id)
                ->where('date_order', '=', $reservation->date_reserve)
                ->first();
        }

        return response()->view('rooms_reservation.index', [
            'reservations' => $reservations
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'fio' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'hours' => ['required', 'integer', 'min:1'],
            'capacity' => ['required', 'integer', 'min:1'],
            'date_reserve' => ['required', 'date'],
            'products' => ['array'],
            'products.*' => ['array'],
            'products.*.id' => ['integer'],
            'products.*.count' => ['integer'],
        ]);

        $fields = [
            'room_id' => $request->post('room_id'),
            'fio' => $request->post('fio'),
            'email' => $request->post('email'),
            'hours' => $request->post('hours'),
            'capacity' => $request->post('capacity'),
            'date_reserve' => Carbon::parse($request->post('date_reserve'))->toDateTime(),
        ];

        RoomsReservation::query()->create($fields);
        if ($request->filled('products')) {
            $orderID = Order::restore(0, [
                'room_id' => $request->post('room_id'),
                'status' => 1,
                'date_order' => $fields['date_reserve'],
            ]);
            foreach ($request->post('products') as $product) {
                $orderProductFields = [
                    'order_id' => $orderID,
                    'product_id' => $product['id'],
                    'count' => $product['count'],
                ];
                OrdersProduct::restore(0, $orderProductFields);
            }
        }

        return redirect()->route('welcome')->with('status', 'reservation');
    }

    public function edit(int $id): Response
    {
        $reservation = RoomsReservation::with('room')
            ->find($id);
        $reservation->order = Order::query()
            ->with('products.product')
            ->where('room_id', '=', $reservation->room_id)
            ->where('date_order', '=', $reservation->date_reserve)
            ->first();

        return response()->view('rooms_reservation.edit', [
            'reservation' => $reservation
        ]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $fields = [
            'date_reserve' =>  Carbon::parse($request->post('date_reserve'))->toDateTime(),
            'capacity' => $request->post('capacity'),
            'hours' => $request->post('hours'),
        ];

        $reserve = RoomsReservation::query()->with('order')->find($id);
        $reserve->update($fields);

        if ($request->filled('products')) {
            if ($reserve->order->isNotEmpty()) {
                $orderID = $reserve->order->id;
                $orderID = Order::restore($orderID, [
                    'room_id' => $request->post('room_id'),
                    'status' => 1,
                    'date_order' => $fields['date_reserve'],
                ]);
                $currentProducts = OrdersProduct::query()->select('id', 'product_id')
                    ->where('order_id', '=', $orderID)
                    ->pluck('id', 'product_id')
                    ->toArray();
                foreach ($request->post('products') as $product) {
                    $orderProductID = 0;
                    $orderProductFields = [
                        'order_id' => $orderID,
                        'product_id' => $product['id'],
                        'count' => $product['count'],
                    ];
                    if (!empty($currentProducts[$product['id']])) {
                        $orderProductID = $currentProducts[$product['id']];
                    }

                    OrdersProduct::restore($orderProductID, $orderProductFields);
                }
            }
        }

        return Redirect::route('reservation.edit', $id)->with('status', 'reservation-updated');
    }

    public function destroy(int $id): RedirectResponse
    {
        RoomsReservation::query()->where('id', '=', $id)->delete();

        return redirect()->route('reservation.index');
    }

    public function destroyWelcome(int $id): RedirectResponse
    {
        RoomsReservation::query()->where('id', '=', $id)->delete();

        return redirect()->route('reservations.welcome');
    }
}
