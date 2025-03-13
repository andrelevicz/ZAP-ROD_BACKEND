<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|ulid|exists:users,id',
            'name' => 'required|string|max:255',
            'fantasy_name' => 'nullable|string|max:255',
            'cnpj' => 'required|string|size:14|unique:companies',
            'legal_email' => 'required|email|unique:companies',
            'phone' => 'required|string|max:20',
        ];
    }
}