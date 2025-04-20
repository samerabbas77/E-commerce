<?php

namespace App\Http\Requests\Api\User\Auth;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * trim whitespace from strings or convert phone numbers to a standard format.
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'first_name' => ucwords(trim($this->first_name)) ,
            'last_name' => ucwords(trim($this->last_name)),
            'email' => strtolower(trim($this->email)),
            'phone' => preg_replace('/[^0-9]/', '', $this->phone), // Remove non-numeric characters from phone
            'address' => trim($this->address),
            'telegram_user_id' => trim($this->telegram_user_id),
        ]);
    }
    //....................
    //....................

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name'     => ['required', 'string', 'max:35'],
            'last_name'      => ['required', 'string', 'max:35'],
            'email'          => ['required', 'email', 'unique:users,email'],
            'password'       => ['required', 'confirmed', 'max:16', Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()], // Enforce complexity
            'phone'          => ['required', 'unique:users,phone', 'string', 'max:25', 'regex:/^\+?[0-9]{10,15}$/'], // Validate phone number format
            'address'        => ['required', 'string', 'max:255'],
            'is_male'        => ['required', 'boolean'],
            'birthdate'      => ['required', 'date', 'before:-18 years'], // Ensure users are at least 18 years old
            'telegram_user_id' => ['nullable', 'string', 'unique:users,telegram_user_id'], // Make this field optional if not required
        ];
    }
//............................................
//............................................
    
    public function attributes(): array
    {
        return [
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email Address',
            'password' => 'Password',
            'phone' => 'Phone Number',
            'address' => 'Address',
            'is_male' => 'Gender',
            'birthdate' => 'Date of Birth',
            'telegram_user_id' => 'Telegram User ID',
        ];
    }

    //.......................................
    //.......................................
    public function messages(): array
    {
        return [
            'required' => 'The :attribute field is required.',
            'string' => 'The :attribute must be a valid string.',
            'first_name.max' => 'The :attribute must not exceed 35 characters.',
            'last_name.max' => 'The :attribute must not exceed 35 characters.',
            'password.max' => 'The password must not exceed 16 characters.',
            'password.phone' => 'The password must not exceed 25 characters.',
            'email.email' => 'The email must be a valid email address.',
            'unique' => 'This :attribute is already registered.',
            'confirmed' => 'The :attribute confirmation does not match.',
            'min' => 'The :attribute must be at least 8 characters.',
            'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'phone.regex' => 'The phone number must be in a valid format.',
            'birthdate.before' => 'The birthdate must be a valid date before today.',
            'telegram_user_id.unique' => 'This Telegram user ID is already registered.',
        ];
    }
}
