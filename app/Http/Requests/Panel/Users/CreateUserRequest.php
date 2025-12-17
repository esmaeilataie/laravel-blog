<?php

namespace App\Http\Requests\Panel\Users;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'persian_alpha', 'max:255'],
            'email' => ['required', 'email', 'lowercase', 'string', 'unique:' . User::class],
            'mobile' => ['required', 'string', 'max:255', 'unique:' . User::class, 'ir_mobile'],
            'role' => ['required', Rule::in(['user', 'author', 'admin'])]
        ];
    }
}
