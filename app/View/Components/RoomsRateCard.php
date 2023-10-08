<?php

namespace App\View\Components;

use App\Modules\Rooms\Models\RoomsRate;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RoomsRateCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public RoomsRate $rate
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('rooms_rates.partials.rooms-rate-card');
    }
}
