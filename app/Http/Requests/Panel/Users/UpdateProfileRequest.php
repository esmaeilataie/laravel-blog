<?php

namespace App\Http\Requests\Panel\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
            'profile' => ['nullable', 'image', 'max:2024'],
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'ir_mobile', Rule::unique('users')->ignore(auth()->user())],
            'email' => ['required', 'string', 'email', Rule::unique('users')->ignore(auth()->user())],
            'password' => ['nullable', 'min:8']
        ];
    }
}
