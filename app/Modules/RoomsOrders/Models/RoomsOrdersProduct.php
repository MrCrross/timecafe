<?php

namespace App\Modules\RoomsOrders\Models;

use App\Modules\Products\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoomsOrdersProduct extends Model
{
    use HasFactory;

    protected $table = 'rooms_orders_products';
    public $timestamps = true;
    protected $guarded = [];

    public function order(): BelongsTo
    {
        return $this->belongsTo(RoomsOrder::class, 'order_id', 'id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
