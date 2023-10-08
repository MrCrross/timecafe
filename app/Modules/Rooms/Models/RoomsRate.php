<?php

namespace App\Modules\Rooms\Models;

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

    public static function restore(int $id, array $fields): int
    {
        return self::query()
            ->updateOrCreate(['id' => $id], $fields)->id;
    }

    public static function deleteByID(int $id): void
    {
        Room::deleteByRateID($id);
        self::query()
            ->where('id', '=', $id)
            ->delete();
    }
}
