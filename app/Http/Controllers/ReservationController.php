<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Modules\Orders\Models\Order;
use App\Modules\Orders\Models\OrdersProduct;
use App\Modules\Products\Models\Product;
use App\Modules\Rooms\Models\Room;
use App\Modules\Rooms\Models\RoomsReservation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

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

    public function create(): Response
    {
        $rooms = Room::with('rate')
            ->orderBy('name')
            ->get();

        $products = Product::selectRaw('
            products.id as value,
            CONCAT(products_types.name, " ", products.name) as label,
            (
               products.price -
               IFNULL(
                       (SELECT SUM(stocks.price)
                        FROM stocks
                        WHERE stocks.product_id = products.id
                          and stocks.expired_date > now()),
                       0
               )
           ) as price
        ')
            ->join('products_types', 'products_types.id', '=', 'products.type_id')
            ->orderBy('products.name')
            ->get();
        $users = collect([
            (object) [
                'value' => 0,
                'label' => 'Выберите'
            ]
        ])->merge(User::query()
            ->selectRaw('
                users.id as value,
                CONCAT(users.fio, " (", users.email, ")") as label
            ')
            ->where('status', '=', 1)
            ->get());

        return response()->view('rooms_reservation.create', [
            'rooms' => $rooms,
            'products' => $products,
            'users' => $users,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('welcome')->with('error', 'no_auth');
        }
        $request->validate([
            'fio' => ['required', 'string', 'max:255'],
            'room_id' => ['required', 'integer', Rule::exists(Room::class, 'id')],
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
            'date_reserve' => Carbon::parse($request->post('date_reserve'))->toDateTimeString(),
        ];

        $check = RoomsReservation::query()
            ->where('room_id', '=', $fields['room_id'])
            ->whereRaw('
                (DATE_ADD(date_reserve, INTERVAL hours HOUR) >= ? OR DATE_ADD(?, INTERVAL ? HOUR) <= date_reserve)
            ', [Carbon::parse($request->post('date_reserve'))->toDateTimeString(), Carbon::parse($request->post('date_reserve'))->toDateTimeString(), $request->post('hours')])
            ->first();
        if (!empty($check)) {
            return redirect()->route('welcome')->with('error', 'closed');
        }

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

    public function storeAdmin(Request $request): RedirectResponse
    {
        if ($request->filled('user_id')) {
            $request->validate([
                'user_id' => ['required', 'integer', Rule::exists(User::class, 'id')],
                'room_id' => ['required', 'integer', Rule::exists(Room::class, 'id')],
                'hours' => ['required', 'integer', 'min:1'],
                'capacity' => ['required', 'integer', 'min:1'],
                'date_reserve' => ['required', 'date'],
                'products' => ['array'],
                'products.*' => ['array'],
                'products.*.id' => ['integer'],
                'products.*.count' => ['integer'],
            ]);
            $user = User::query()->find($request->post('user_id'));
            $fio = $user->fio;
            $email = $user->email;
        } else {
            $request->validate([
                'fio' => ['required', 'string', 'max:255'],
                'room_id' => ['required', 'integer', Rule::exists(Room::class, 'id')],
                'email' => ['required', 'email', 'max:255'],
                'hours' => ['required', 'integer', 'min:1'],
                'capacity' => ['required', 'integer', 'min:1'],
                'date_reserve' => ['required', 'date'],
                'products' => ['array'],
                'products.*' => ['array'],
                'products.*.id' => ['integer'],
                'products.*.count' => ['integer'],
            ]);
            $fio = $request->post('fio');
            $email = $request->post('email');
        }

        $fields = [
            'room_id' => $request->post('room_id'),
            'fio' => $fio,
            'email' => $email,
            'hours' => $request->post('hours'),
            'capacity' => $request->post('capacity'),
            'date_reserve' => Carbon::parse($request->post('date_reserve'))->toDateTimeString(),
        ];

        $check = RoomsReservation::query()
            ->where('room_id', '=', $fields['room_id'])
            ->whereRaw('
                (DATE_ADD(date_reserve, INTERVAL hours HOUR) >= ? OR DATE_ADD(?, INTERVAL ? HOUR) <= date_reserve)
            ', [Carbon::parse($request->post('date_reserve'))->toDateTimeString(), Carbon::parse($request->post('date_reserve'))->toDateTimeString(), $request->post('hours')])
            ->first();
        if (!empty($check)) {
            return redirect()->route('reservation.create')->with('error', 'Уже занято');
        }

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

        return redirect()->route('reservation.create')->with('status', 'reservation-created');
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
