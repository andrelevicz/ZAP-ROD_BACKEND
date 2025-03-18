<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Instance\StoreInstanceRequest;
use App\Http\Requests\UpdateInstanceRequest;
use App\Http\Resources\InstanceResource;
use App\Models\EvolutionInstance;
use App\Models\Instance;
use App\Services\InstanceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class InstanceController extends Controller
{
    public function __construct(
        private InstanceService $instanceService
    ) {}

    public function index(): AnonymousResourceCollection
    {
        $instances = $this->instanceService->getAllInstances();
        return InstanceResource::collection($instances);
    }

    public function store(StoreInstanceRequest $request): InstanceResource
    {
        $validated = $request->validated();
        $instance = $this->instanceService->createInstance($validated);
        return new InstanceResource($instance);
    }

    public function show(int $id): InstanceResource
    {
        $fullInstance = $this->instanceService->getInstanceById($id);
        return new InstanceResource($fullInstance);
    }

    public function update(UpdateInstanceRequest $request, Instance $instance): InstanceResource
    {
        $validated = $request->validated();
        $updatedInstance = $this->instanceService->updateInstance($instance, $validated);
        return new InstanceResource($updatedInstance);
    }

    public function destroy(Instance $instance): JsonResponse
    {
        $this->instanceService->deleteInstance($instance);
        return response()->json([
            'message' => 'Instance deleted successfully'
        ], 204);
    }
}