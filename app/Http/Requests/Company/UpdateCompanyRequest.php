<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'sometimes|ulid|exists:users,id',
            'name' => 'sometimes|string|max:255',
            'fantasy_name' => 'nullable|string|max:255',
            'cnpj' => 'sometimes|string|size:14|unique:companies,cnpj,'.$this->company->id,
            'legal_email' => 'sometimes|email|unique:companies,legal_email,'.$this->company->id,
            'phone' => 'sometimes|string|max:20',
            'address_id' => 'sometimes|ulid|exists:addresses,id',
            'gateway_custumer_receiver_id' => 'nullable|string|unique:companies,gateway_custumer_receiver_id,'.$this->company->id
        ];
    }
}