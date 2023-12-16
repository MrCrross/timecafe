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
use App\OrderTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RoomsController extends Controller
{
    use OrderTrait;

    /**
     * Display a listing of the resource.
     */
    public function welcome(Request $request): Response
    {
        $rooms = Room::with('rate')
            ->when($request->filled('name'), function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->query('name')}%");
            })
            ->when($request->filled('min_capacity'), function ($query) use ($request) {
                $query->where('capacity', '>', $request->query('min_capacity'));
            })
            ->when($request->filled('max_capacity'), function ($query) use ($request) {
                $query->where('capacity', '<', $request->query('max_capacity'));
            })
            ->when((int)$request->query('order_name') !== 0, function ($query) use ($request) {
                $query->orderBy('name', (int)$request->query('order_name') === 1 ? 'ASC' : 'DESC');
            })
            ->when((int)$request->query('order_rate') !== 0, function ($query) use ($request) {
                $query->orderBy('rate_id', (int)$request->query('order_rate') === 1 ? 'ASC' : 'DESC');
            })
            ->when((int)$request->query('order_capacity') !== 0, function ($query) use ($request) {
                $query->orderBy('capacity', (int)$request->query('order_capacity') === 1 ? 'ASC' : 'DESC');
            })
            ->when(
                (int)$request->query('order_name') === 0 &&
                (int)$request->query('order_rate') === 0 &&
                (int)$request->query('order_capacity') === 0,
                function ($query) use ($request) {
                    $query->orderBy('name')
                        ->orderBy('rate_id');
                }
            )
            ->paginate(6);
        $filter = (object)[
            'name' => $request->has('name') ? $request->query('name') : '',
            'min_capacity' => $request->has('min_capacity') ? $request->query('min_capacity') : 1,
            'max_capacity' => $request->has('max_capacity') ? $request->query('max_capacity') : '',
        ];
        $order = (object)[
            'default' => self::getOrderDefault(),
            'name' => $request->has('order_name') ? $request->query('order_name') : 0,
            'rate' => $request->has('order_rate') ? $request->query('order_rate') : 0,
            'capacity' => $request->has('order_capacity') ? $request->query('order_capacity') : 0,
        ];

        return response()->view('rooms.welcome', [
            'rooms' => $rooms,
            'filter' => $filter,
            'order' => $order,
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
            ->when((int)$request->query('room_id') !== 0, function ($query) use ($request) {
                $query->where('room_id', '=', $request->query('room_id'));
            })
            ->when($request->query('min_date', '') !== '', function ($query) use ($request) {
                $query->where('date_reserve', '>', Carbon::parse($request->query('min_date'))->toDateTime());
            })
            ->when($request->query('max_date', '') !== '', function ($query) use ($request) {
                $query->where('date_reserve', '<', Carbon::parse($request->query('max_date'))->toDateTime());
            })
            ->when((int)$request->query('order_room') !== 0, function ($query) use ($request) {
                $query->orderBy('room_id', (int)$request->query('order_room') === 1 ? 'ASC' : 'DESC');
            })
            ->orderBy('date_reserve', 'desc')
            ->paginate(6);
        $rooms = collect([
            (object)[
                'value' => '',
                'label' => 'Не выбрано'
            ]
        ]);
        $rooms = $rooms->merge(
            Room::select('id as value', 'name as label')
                ->orderBy('name')
                ->get()
        );
        $filter = (object)[
            'room' => $request->has('room_id') ? $request->query('room_id') : 0,
            'min_date' => $request->has('min_date') ? $request->query('min_date') : null,
            'max_date' => $request->has('max_date') ? $request->query('max_date') : null,
        ];
        $order = (object)[
            'default' => self::getOrderDefault(),
            'room' => $request->has('order_room') ? $request->query('order_room') : 0,
        ];

        return response()->view('rooms_reservation.welcome', [
            'reservations' => $reservations,
            'rooms' => $rooms,
            'filter' => $filter,
            'order' => $order,
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
