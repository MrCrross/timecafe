<?php

namespace App\Modules\Rooms\Requests;

use App\Modules\Rooms\Models\RoomsRate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoomsRatesRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', Rule::unique(RoomsRate::class, 'name')],
            'price' => ['required', 'integer', 'min:1'],
        ];
    }
}
