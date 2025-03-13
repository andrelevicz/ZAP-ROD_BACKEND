<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'street_address' => $this->street_address,
            'address_locality' => $this->address_locality,
            'address_region' => $this->address_region,
            'postal_code' => $this->postal_code,
            'address_country' => $this->address_country,
            'address_complement' => $this->address_complement,
            'coordinates' => [
                'latitude' => $this->latitude,
                'longitude' => $this->longitude
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}