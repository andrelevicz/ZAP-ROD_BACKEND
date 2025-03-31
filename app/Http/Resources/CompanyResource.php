<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'fantasy_name' => $this->fantasy_name,
            'cnpj' => $this->cnpj,
            'legal_email' => $this->legal_email,
            'phone' => $this->phone,
            'gateway_custumer_receiver_id' => $this->gateway_custumer_receiver_id,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString()
        ];
    }

    public function with($request)
    {
        return [
            'message' => 'Empresa criada com sucesso',
            'status' => 201
        ];
    }
}