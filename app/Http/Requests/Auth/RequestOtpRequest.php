<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RequestOtpRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|exists:users,email',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
