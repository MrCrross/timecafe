<?php

namespace App\Modules\Stocks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'stocks';
    protected $guarded = [];
    public $timestamps = true;

    public static function deleteByID(int $id): void
    {
        self::query()
            ->where('id', '=', $id)
            ->delete();
    }
}
