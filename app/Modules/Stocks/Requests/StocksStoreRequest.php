<?php

namespace App\Modules\Stocks\Requests;

use App\Modules\Products\Models\Product;
use App\Modules\Stocks\Models\Stock;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StocksStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', Rule::unique(Stock::class, 'name')],
            'product_id' => ['required', 'integer', Rule::exists(Product::class, 'id')],
            'expired_date' => ['required', 'date'],
            'description' => ['required', 'string'],
            'price' => ['required', 'decimal:2', 'min:0'],
        ];
    }
}
