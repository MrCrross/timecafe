<?php

namespace App\Modules\Rooms\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Rooms\Models\RoomsRate;
use App\Modules\Rooms\Requests\RoomsRatesRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

class RoomsRatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $roomRates = RoomsRate::orderBy('name')->get();

        return response()->view('rooms_rates.index', [
            'rates' => $roomRates
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response()->view('rooms_rates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomsRatesRequest $request): RedirectResponse
    {
        $fields = [
            'name' => $request->post('name'),
            'price' => $request->post('price')
        ];

        RoomsRate::restore(0, $fields);

        return Redirect::route('rooms_rates.create')->with('status', 'rooms_rates-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): Response
    {
        $rate = RoomsRate::find($id);

        return response()->view('rooms_rates.show', [
            'rate' => $rate
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): Response
    {
        $rate = RoomsRate::find($id);

        return response()->view('rooms_rates.edit', [
            'rate' => $rate
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoomsRatesRequest $request, string $id): RedirectResponse
    {
        $fields = [
            'name' => $request->post('name'),
        ];

        RoomsRate::restore($id, $fields);

        return Redirect::route('rooms_rates.edit', $id)->with('status', 'rooms_rates-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        RoomsRate::deleteByID($id);

        return redirect()->route('rooms_rates.index');
    }
}
