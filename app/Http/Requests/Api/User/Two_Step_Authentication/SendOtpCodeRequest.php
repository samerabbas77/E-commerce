<?php

namespace App\Http\Requests\Api\User\Two_Step_Authentication;

use Illuminate\Foundation\Http\FormRequest;

class SendOtpCodeRequest extends FormRequest
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
            'provider' => ['required', 'string', 'in:telegram,sms'],
            'otp_token' => ['required', 'string']
        ];
    }
}
