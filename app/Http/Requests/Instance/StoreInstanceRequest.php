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
        return [
            'instance_name' => ['required', 'string', 'max:255'],
            'company_id' => ['required', 'ulid', 'exists:companies,id']
        ];
    }

    public function messages(): array
    {
        return [
            'instance_name.required' => 'O nome da instância é obrigatório.',
            'instance_name.max' => 'O nome da instância deve ter no máximo 255 caracteres.',
            'company_id.required' => 'A instância deve pertencer a uma empresa.',
            'company_id.ulid' => 'A instância deve pertencer a uma empresa.',
        ];
    }
}