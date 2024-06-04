<?php

namespace App\Modules\Orders\Requests;

use App\Modules\Products\Models\Product;
use App\Modules\Rooms\Models\Room;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrdersStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'room_id' => ['required', 'integer', 'min:1', Rule::exists(Room::class, 'id')],
            'hours' => ['required', 'integer'],
            'products' => ['required', 'array'],
            'products.*' => ['required', 'array'],
            'products.*.id' => ['required', 'integer', 'min:1', Rule::exists(Product::class, 'id')],
            'products.*.count' => ['required', 'integer', 'min:1'],
        ];
    }
}
