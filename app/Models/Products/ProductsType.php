<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductsType extends Model
{
    use HasFactory;

    protected $table = 'products_types';
    protected $guarded = [];
    public $timestamps = true;

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'type_id', 'id');
    }
}
