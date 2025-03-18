<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InstanceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'instance_id' => $this->instance_id,
            'status' => $this->status,
            'api_url' => $this->api_url,
            'webhook_url' => $this->webhook_url,
            'webhook_events' => $this->webhook_events,
            'last_activity' => $this->last_activity,
            'qrcode' => $this->whenNotNull($this->qrcode),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}