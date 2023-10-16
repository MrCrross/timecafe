<?php

namespace App\Modules\Orders\Models;

use App\Modules\Products\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrdersProduct extends Model
{
    use HasFactory;

    protected $table = 'orders_products';
    public $timestamps = true;
    protected $guarded = [];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public static function restore(int $id, array $fields): int
    {
        return self::query()->updateOrCreate(['id' => $id], $fields)->id;
    }

    public static function deleteByOrderID(int $orderID): void
    {
        self::query()
            ->where('order_id', '=', $orderID)
            ->delete();
    }
}
