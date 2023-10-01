<?php

namespace App\Models\Rooms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomsRate extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'rooms_rates';
    public $timestamps = true;
    protected $guarded = [];
}
