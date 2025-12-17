<?php

namespace App\Http\Requests\Panel\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $user = $this->route('user');

        return [
            'name' => ['required', 'string', 'persian_alpha', 'max:255'],
            'email' => ['required', 'email', 'lowercase', 'string',
                Rule::unique('users', 'email')->ignore($user->id)],
            'mobile' => ['required', 'string', 'max:255', 'ir_mobile',
                Rule::unique('users', 'mobile')->ignore($user->id)],
            'role' => ['required', Rule::in(['user', 'author', 'admin'])]
        ];
    }
}
