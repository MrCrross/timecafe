<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'products';
    public $timestamps = true;
    protected $guarded = [];

    public function type(): BelongsTo
    {
        return $this->belongsTo(ProductsType::class, 'type_id', 'id');
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

    public static function deleteByTypeID(int $typeID): void
    {
        self::query()
            ->where('type_id', '=', $typeID)
            ->delete();
    }
}
