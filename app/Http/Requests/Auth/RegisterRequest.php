<?php

namespace App\Http\Requests\Auth;

use App\Models\User\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->guest();
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'role' => ['required', 'string', Rule::in(UserRole::toArray())],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
