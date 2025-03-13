<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'company' => $this->company,
            'name' => $this->name,
            'description' => $this->description,
            'requirements' => $this->requirements,
            'price' => $this->price,
            'duration' => $this->duration,
            'modality' => $this->modality,
            'category' => $this->category,
            'is_available' => $this->is_available,
            'tags' => $this->tags,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}