<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;

class LoginRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'string', Rule::exists(User::class, 'email')],
            'password' => ['required', 'string'],
        ];
    }
}
