<?php

namespace App\Modules\Stocks\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Products\Models\Product;
use App\Modules\Stocks\Requests\StocksStoreRequest;
use App\Modules\Stocks\Requests\StocksUpdateRequest;
use App\Modules\Stocks\Models\Stock;
use App\OrderTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class StocksController extends Controller
{
    use OrderTrait;

    /**
     * Display a listing of the resource.
     */
    public function welcome(Request $request): Response
    {
        $stocks = Stock::with('product')
            ->when($request->filled('name'), function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->query('name')}%");
            })
            ->when((int)$request->query('order_name') !== 0, function ($query) use ($request) {
                $query->orderBy('name', (int)$request->query('order_name') === 1 ? 'ASC' : 'DESC');
            })
            ->paginate(6);
        $filter = (object)[
            'name' => $request->has('name') ? $request->query('name') : '',
        ];
        $order = (object)[
            'default' => self::getOrderDefault(),
            'name' => $request->has('order_name') ? $request->query('order_name') : 0,
        ];

        return response()->view('stocks.welcome', [
            'stocks' => $stocks,
            'filter' => $filter,
            'order' => $order,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $stocks = Stock::with('product')->get();

        return response()->view('stocks.index', [
            'stocks' => $stocks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $products = Product::selectRaw('
            products.id as value,
            CONCAT(products_types.name, " ", products.name) as label
        ')
            ->join('products_types', 'products_types.id', '=', 'products.type_id')
            ->orderBy('products.name')
            ->get();

        return response()->view('stocks.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StocksStoreRequest $request): RedirectResponse
    {
        $fields = [
            'name' => $request->post('name'),
            'product_id' => (int)$request->post('product_id'),
            'description' => $request->post('description'),
            'price' => $request->post('price'),
            'expired_date' => Carbon::parse($request->post('expired_date'))->toDateTimeString(),
        ];
        $productPrice = Product::query()
            ->selectRaw('
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
            ->find($fields['product_id'])->price;
        if ($productPrice < $fields['price']) {
            return Redirect::route('stocks.create')->with('error', 'Цена акции больше стоимости товара с учетом имеющихся действующих акций.');
        }

        Stock::query()->create($fields)->id;

        return Redirect::route('stocks.create')->with('status', 'stock-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): Response
    {
        $stock = Stock::with('rate')->find($id);

        return response()->view('stocks.show', [
            'stock' => $stock
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): Response
    {
        $stock = Stock::find($id);
        $products = Product::selectRaw('
            products.id as value,
            CONCAT(products_types.name, " ", products.name) as label
        ')
            ->join('products_types', 'products_types.id', '=', 'products.type_id')
            ->orderBy('products.name')
            ->get();

        return response()->view('stocks.edit', [
            'stock' => $stock,
            'products' => $products,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StocksUpdateRequest $request, int $id): RedirectResponse
    {
        $request->validate(['name' => Rule::unique(Stock::class, 'name')->ignore($id)]);

        $fields = [
            'name' => $request->post('name'),
            'description' => $request->post('description'),
            'product_id' => $request->post('product_id'),
            'price' => $request->post('price'),
            'expired_date' => Carbon::parse($request->post('expired_date'))->toDateTimeString(),
        ];

        $productPrice = Product::query()
            ->selectRaw('
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
            ->find($fields['product_id'])->price;
        if ($productPrice < $fields['price']) {
            return Redirect::route('stocks.edit', $id)->with('error', 'Цена акции больше стоимости товара с учетом имеющихся действующих акций.');
        }

        Stock::query()->find($id)->update($fields);

        return Redirect::route('stocks.edit', $id)->with('status', 'stock-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        Stock::deleteByID($id);

        return redirect()->route('stocks.index');
    }
}
