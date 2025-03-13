<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Services\StoreServiceRequest;
use App\Http\Requests\Services\UpdateServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Services\ServiceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ServiceController extends Controller
{
    public function __construct(
        private ServiceService $serviceService
    ) {}

    public function index(): AnonymousResourceCollection
    {
        $services = Service::with(['company', 'category', 'tags'])->paginate();
        return ServiceResource::collection($services);
    }

    public function store(StoreServiceRequest $request): ServiceResource
    {
        $validated = $request->validated();
        $service = $this->serviceService->createService($validated);
        return new ServiceResource($service);
    }

    public function show(Service $service): ServiceResource
    {
        return new ServiceResource($service);
    }

    public function update(UpdateServiceRequest $request, Service $service): ServiceResource
    {
        $validated = $request->validated();
        $updatedService = $this->serviceService->updateService($service, $validated);
        return new ServiceResource($updatedService->load(['company', 'category', 'tags']));
    }

    public function destroy(Service $service): JsonResponse
    {
        $this->serviceService->deleteService($service);
        return response()->json(null, 204);
    }
}