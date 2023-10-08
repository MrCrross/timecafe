<?php

namespace App\View\Components;

use App\Modules\ProductsTypes\Models\ProductsType;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductTypeCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ProductsType $type
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('products_types.partials.product-type-card');
    }
}
