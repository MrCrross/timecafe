<?php

namespace App\Modules\Products\Requests;

use App\Modules\ProductsTypes\Models\ProductsType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductsUpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'decimal:2'],
            'image' => ['image', 'nullable'],
            'type_id' => ['required', 'integer', 'min:1', Rule::exists(ProductsType::class, 'id')]
        ];
    }
}
