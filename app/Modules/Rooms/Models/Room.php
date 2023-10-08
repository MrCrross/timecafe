<?php

namespace App\Modules\Rooms\Models;

use App\Modules\RoomsOrders\Models\RoomsOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'rooms';
    public $timestamps = true;
    protected $guarded = [];

    public function reservation(): HasMany
    {
        return $this->hasMany(RoomsReservation::class, 'id', 'room_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(RoomsOrder::class, 'id', 'room_id');
    }

    public function rate(): BelongsTo
    {
        return $this->belongsTo(RoomsRate::class, 'rate_id', 'id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(RoomsImage::class, 'id', 'room_id');
    }

    public static function restore(int $id, array $fields): int
    {
        return self::query()
            ->updateOrCreate(['id' => $id], $fields)->id;
    }

    public static function deleteByID(int $id): void
    {
        self::query()
            ->where('id', '=', $id)
            ->delete();
    }

    public static function deleteByRateID(int $rateID): void
    {
        self::query()
            ->where('rate_id', '=', $rateID)
            ->delete();
    }
}
