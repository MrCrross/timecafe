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
}
