<?php

namespace App\Modules\Rooms\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FilesModel;
use App\Modules\Rooms\Models\RoomsImage;
use App\Modules\Rooms\Models\RoomsReservation;
use App\Modules\Rooms\Requests\RoomsImagesRequest;
use App\Modules\Rooms\Requests\RoomsStoreRequest;
use App\Modules\Rooms\Requests\RoomsUpdateRequest;
use App\Modules\Rooms\Models\Room;
use App\Modules\Rooms\Models\RoomsRate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function welcome(Request $request): Response
    {
        $rooms = Room::with('rate')
            ->when($request->has('name'), function ($query) use($request) {
                $query->where('name', 'like', "%{$request->query('name')}%");
            })
            ->orderBy('name')
            ->orderBy('rate_id')
            ->paginate(6);

        return response()->view('rooms.welcome', [
            'rooms' => $rooms
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function welcomeReservations(Request $request): Response
    {
        $reservations = RoomsReservation::with('room')
            ->where('email', '=', Auth::user()->email)
            ->when($request->filled('room_id'), function ($query) use($request) {
                $query->where('room_id', '=', $request->query('room_id'));
            })
            ->orderBy('date_reserve', 'desc')
            ->paginate(6);
        $rooms = collect([(object)[
            'value' => '',
            'label' => 'Не выбрано'
        ]]);
        $rooms = $rooms->merge(Room::select('id as value', 'name as label')
            ->orderBy('name')
            ->get());

        return response()->view('rooms_reservation.welcome', [
            'reservations' => $reservations,
            'rooms' => $rooms,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $rooms = Room::with('rate')
            ->orderBy('name')
            ->orderBy('rate_id')
            ->get();

        return response()->view('rooms.index', [
            'rooms' => $rooms
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $rates = RoomsRate::select('id as value', 'name as label')->get();

        return response()->view('rooms.create', [
            'rates' => $rates
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomsStoreRequest $request): RedirectResponse
    {
        $fields = [
            'name' => $request->post('name'),
            'capacity' => $request->post('capacity'),
            'rate_id' => $request->post('rate_id'),
        ];

        $id = Room::restore(0, $fields);
        $this->saveMainImage($id, $request->file('image'));

        return Redirect::route('rooms.create')->with('status', 'room-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): Response
    {
        $room = Room::with('rate')->find($id);

        return response()->view('rooms.show', [
            'room' => $room
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): Response
    {
        $rates = RoomsRate::select('id as value', 'name as label')->get();
        $room = Room::with('rate', 'images')->find($id);

        return response()->view('rooms.edit', [
            'room' => $room,
            'rates' => $rates
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoomsUpdateRequest $request, int $id): RedirectResponse
    {
        $fields = [
            'name' => $request->post('name'),
            'capacity' => $request->post('capacity'),
            'rate_id' => $request->post('rate_id'),
        ];

        Room::restore($id, $fields);

        if ($request->hasFile('image')) {
            $this->saveMainImage($id, $request->file('image'));
        }

        return Redirect::route('rooms.edit', $id)->with('status', 'room-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        RoomsReservation::query()->where('room_id', '=', $id)->delete();
        Room::deleteByID($id);

        return redirect()->route('rooms.index');
    }

    /**
     * @param RoomsImagesRequest $request
     * @param int $roomID
     *
     * @return RedirectResponse
     */
    public function storeImage(RoomsImagesRequest $request, int $roomID): RedirectResponse
    {
        $files = $request->file('images');
        $countImages = RoomsImage::getCountImagesRoom($roomID);
        foreach ($files as $file) {
            $countImages++;
            $path = "/rooms/{$roomID}/";
            $fileName = "additional{$countImages}.{$file->clientExtension()}";
            FilesModel::putFileAs($path, $file, $fileName);
            RoomsImage::store([
                'room_id' => $roomID,
                'image' => FilesModel::getPathSave($path, $fileName),
            ]);
        }

        return redirect()->route('rooms.edit', $roomID);
    }

    /**
     * @param int $imageID
     *
     * @return RedirectResponse
     */
    public function deleteImage(int $imageID): RedirectResponse
    {
        $image = RoomsImage::find($imageID);
        RoomsImage::deleteByID($imageID);

        return redirect()->route('rooms.edit', $image->room_id);
    }

    /**
     * @param int $roomID
     * @param UploadedFile $file
     *
     * @return void
     */
    private function saveMainImage(int $roomID, UploadedFile $file): void
    {
        $path = "/rooms/{$roomID}/";
        $fileName = "main.{$file->clientExtension()}";
        FilesModel::putFileAs($path, $file, $fileName);
        Room::restore($roomID, [
            'image' => FilesModel::getPathSave($path, $fileName),
        ]);
    }
}
