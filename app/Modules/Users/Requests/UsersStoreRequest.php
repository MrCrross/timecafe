<?php

namespace App\Modules\Users\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UsersStoreRequest extends FormRequest
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
            'fio' => ['required', 'string', 'max:255'],
            'login' => ['required', 'string', 'max:255', Rule::unique(User::class, 'login')],
            'email' => ['required', 'email', 'max:255', Rule::unique(User::class, 'email')],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'params' => ['required', 'array'],
            'params.*' => ['required', 'integer'],
        ];
    }
}
