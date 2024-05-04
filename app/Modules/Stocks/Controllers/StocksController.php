<?php

namespace App\Modules\Stocks\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Stocks\Models\Stock;
use App\OrderTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

class StocksController extends Controller
{
    use OrderTrait;

    /**
     * Display a listing of the resource.
     */
    public function welcome(Request $request): Response
    {
        $stocks = Stock::when($request->filled('name'), function ($query) use ($request) {
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
        $stocks = Stock::get();

        return response()->view('stocks.index', [
            'stocks' => $stocks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response()->view('stocks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StocksStoreRequest $request): RedirectResponse
    {
        $fields = [
            'name' => $request->post('name'),
            'capacity' => $request->post('capacity'),
            'rate_id' => $request->post('rate_id'),
        ];

        $id = Stock::restore(0, $fields);
        $this->saveMainImage($id, $request->file('image'));

        return Redirect::route('stocks.create')->with('status', 'Stock-created');
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

        return response()->view('stocks.edit', [
            'stock' => $stock
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StocksUpdateRequest $request, int $id): RedirectResponse
    {
        $fields = [
            'name' => $request->post('name'),
            'capacity' => $request->post('capacity'),
            'rate_id' => $request->post('rate_id'),
        ];

        Stock::restore($id, $fields);

        if ($request->hasFile('image')) {
            $this->saveMainImage($id, $request->file('image'));
        }

        return Redirect::route('stocks.edit', $id)->with('status', 'Stock-updated');
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
