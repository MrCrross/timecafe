<?php

namespace App\Models\Desks;

use App\Models\Products\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DesksOrder extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'desks_orders';
    public $timestamps = true;
    protected $guarded = [];

    public function desk(): BelongsTo
    {
        return $this->belongsTo(Desk::class, 'desk_id', 'id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'desks_orders_products', 'order_id', 'product_id');
    }
}
