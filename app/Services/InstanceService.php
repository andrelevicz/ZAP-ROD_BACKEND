<?php

namespace App\Services;

use App\Models\Instance;
use Illuminate\Database\Eloquent\Collection;

class InstanceService
{
    public function getAllInstances(): Collection
    {
        return Instance::all();
    }

    public function createInstance(array $data): Instance
    {
        
        return Instance::create($data);
    }

    public function getInstanceById(int $id): Instance
    {
        return Instance::findOrFail($id);
    }

    public function updateInstance(Instance $instance, array $data): Instance
    {
        $instance->update($data);
        return $instance->fresh();
    }

    public function deleteInstance(Instance $instance): void
    {
        $instance->delete();
    }
}