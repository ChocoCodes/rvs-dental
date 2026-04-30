<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AuthenticateLoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string'
        ];
    }

    public function messages(): array {
        return [
            'email.required' => 'Email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Password is required.',
        ];
    }
}
