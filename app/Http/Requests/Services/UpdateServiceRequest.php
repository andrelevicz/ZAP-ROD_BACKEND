<?php

namespace App\Http\Requests\Services;

use App\Http\Requests\Services\StoreServiceRequest;

class UpdateServiceRequest extends StoreServiceRequest
{
    public function rules()
    {
        return array_merge(parent::rules(), [
            'company_id' => 'sometimes|required|exists:companies,id',
        ]);
    }
}