<?php

namespace App\Services;

use App\Enums\InstanceStatusEnum;
use App\Models\Instance;
use Illuminate\Database\Eloquent\Collection;
use App\Services\EvolutionApi\EvolutionApiService;

class InstanceService
{

    protected $evolutionService;

    public function __construct(EvolutionApiService $evolutionService)
    {
        $this->evolutionService = $evolutionService;
    }

    public function getAllInstances(): Collection
    {
        return Instance::all();
    }

    public function createInstance(array $data): array
    {   
        $instance = null;
        
        try {
            $instance = $this->evolutionService->createInstance([
                "instanceName" => $data['instance_name']
            ]);
    
            if(!$instance) {
                return ['error' => 'Erro ao criar instância'];
            }
    
            $instanceData = [
                'name' => $instance['instance']['instanceName'],
                'instance_id' => $instance['instance']['instanceId'],
                'user_id' => auth()->id(),
                'company_id' => $data['company_id'],
                'status' => InstanceStatusEnum::getCode($instance['instance']['status'])?->value,
                'last_activity' => now(),
                'qrcode' => $instance['qrcode']['base64'],
            ];
    
            $createdInstance = Instance::create($instanceData);

            if(!$createdInstance) {
                return ['error' => 'Erro ao criar instância'];
            }
    
            return [
                'instance' => $instance,
            ];
    
        } catch (\Exception $e) {
            if ($instance && isset($instance['instance']['instanceName'])) {
                $this->evolutionService->deleteInstance($instance['instance']['instanceName']);
            }
            
            return [
                'error' => $e->getMessage() . $e->getTraceAsString()
            ];
        }   
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