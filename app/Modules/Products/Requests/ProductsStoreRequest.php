<?php

namespace App\Modules\Products\Requests;

use App\Modules\Products\Models\Product;
use App\Modules\ProductsTypes\Models\ProductsType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductsStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', Rule::unique(Product::class, 'name')],
            'price' => ['required', 'integer'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'type_id' => ['required', 'integer', 'min:1', Rule::exists(ProductsType::class, 'id')]
        ];
    }
}
