<?php

namespace App\Models\Rooms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
}
