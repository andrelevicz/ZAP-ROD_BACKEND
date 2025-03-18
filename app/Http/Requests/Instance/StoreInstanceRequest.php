<?php

namespace App\Http\Requests\Instance;

use Illuminate\Foundation\Http\FormRequest;

class StoreInstanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [];
    }
}