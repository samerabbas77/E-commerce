<?php

namespace App\Http\Requests\Admin\Captcha;

use Illuminate\Foundation\Http\FormRequest;

class VerfyCaptcaRequest extends FormRequest
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
             'g-recaptcha-response' => ['required','string'],
        ];
    }
}
