<?php

namespace App\Http\Requests\Api\User\ResetPassword;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Allow all users to reset their password
    }

    public function rules(): array
    {
        return [
            'email'    => 'required|email|exists:users,email',
            'token'    => 'required|string|min:8',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
}
