<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
