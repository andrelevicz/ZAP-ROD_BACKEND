<?php

namespace App\Services;

use App\Models\Service;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class ServiceService
{
    public function createService(array $data): Service
    {
        DB::beginTransaction();
        try {
            $service = Service::create($data);
        
            DB::commit();
            return $service;
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error('Failed to create service: ' . $e->getMessage());
            throw $e;
        }
    }

    public function updateService(Service $service, array $data): Service
    {
        DB::beginTransaction();
        try {
            $service->update($data);
            
            if (isset($data['tags'])) {
                $service->tags()->sync($data['tags']);
            }
            
            DB::commit();
            return $service->refresh();
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error('Failed to update service: ' . $e->getMessage());
            throw $e;
        }
    }

    public function deleteService(Service $service): void
    {
        try {
            $service->tags()->detach();
            $service->delete();
        } catch (Throwable $e) {
            Log::error('Failed to delete service: ' . $e->getMessage());
            throw $e;
        }
    }
}