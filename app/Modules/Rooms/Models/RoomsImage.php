<?php

namespace App\Modules\Rooms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoomsImage extends Model
{
    use HasFactory;

    protected $table = 'rooms_images';
    protected $guarded = [];
    public $timestamps = true;

    public function rooms(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    public static function store(array $fields): void
    {
        self::query()->create($fields);
    }

    public static function deleteByID(int $imageID): void
    {
        self::query()
            ->where('id', '=', $imageID)
            ->delete();
    }

    public static function getCountImagesRoom(int $roomID): int
    {
        return self::query()
            ->where('room_id', '=', $roomID)
            ->count('id');
    }
}
