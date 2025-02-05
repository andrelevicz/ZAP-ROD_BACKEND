<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginOtpRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|string|email',
            'otp_code' => 'required|string|min:4|max:6',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
