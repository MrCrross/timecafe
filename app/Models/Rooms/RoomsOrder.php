<?php

namespace App\Models\Rooms;

use App\Models\Products\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomsOrder extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'rooms_orders';
    public $timestamps = true;
    protected $guarded = [];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'rooms_orders_products', 'order_id', 'product_id');
    }
}
