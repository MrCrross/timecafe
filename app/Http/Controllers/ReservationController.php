<?php

namespace App\Http\Controllers;

use App\Modules\Rooms\Models\Room;
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
            'date_reserve' => ['required', 'date']
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

        return redirect()->route('welcome')->with('status', 'reservation');
    }

    public function edit(int $id): Response
    {
        $reservation = RoomsReservation::with('room')
            ->find($id);

        return response()->view('rooms_reservation.edit', [
            'reservation' => $reservation
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $fields = [
            'date_reserve' =>  Carbon::parse($request->post('date_reserve'))->toDateTime(),
            'capacity' => $request->post('capacity'),
            'hours' => $request->post('hours'),
        ];

        RoomsReservation::query()->updateOrCreate(['id' => $id], $fields);

        return Redirect::route('reservation.edit', $id)->with('status', 'reservation-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        RoomsReservation::query()->where('room_id', '=', $id)->delete();

        return redirect()->route('reservation.index');
    }
}
