<?php

namespace App\Models\Desks;

use App\Models\Products\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DesksOrdersProduct extends Model
{
    use HasFactory;

    protected $table = 'desks_orders_products';
    public $timestamps = true;
    protected $guarded = [];

    public function order(): BelongsTo
    {
        return $this->belongsTo(DesksOrder::class, 'order_id', 'id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
