<?php

namespace App\Modules\ProductsTypes\Models;

use App\Modules\Products\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductsType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products_types';
    protected $guarded = [];
    public $timestamps = true;

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'type_id', 'id');
    }

    public static function restore(int $id, array $fields): int
    {
        return self::query()
            ->updateOrCreate(['id' => $id], $fields)->id;
    }

    public static function deleteByID(int $id): void
    {
        Product::deleteByTypeID($id);
        self::query()
            ->where('id', '=', $id)
            ->delete();
    }
}
