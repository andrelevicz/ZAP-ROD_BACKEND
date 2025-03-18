<?php

namespace App\Services;

use App\Exceptions\EvolutionApiException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EvolutionApiService
{
    private string $baseUrl;
    private string $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.evolution.api_url');
        $this->apiKey = config('services.evolution.api_key');
    }

    private function sendRequest(string $method, string $endpoint, array $data = []): Response
    {
        $url = $this->baseUrl . $endpoint;
        
        $response = Http::withHeaders([
            'apikey' => $this->apiKey,
            'Content-Type' => 'application/json'
        ])->{$method}($url, $data);

        $this->logRequest($method, $url, $data, $response);
        
        if ($response->failed()) {
            throw new EvolutionApiException(
                $response->json('error') ?? 'API request failed',
                $response->status()
            );
        }

        return $response;
    }

    private function logRequest(string $method, string $url, array $data, Response $response): void
    {
        Log::channel('evolution')->debug('Evolution API Request', [
            'method' => $method,
            'url' => $url,
            'payload' => $data,
            'response_status' => $response->status(),
            'response_body' => $response->json()
        ]);
    }

    public function createInstance(array $instanceData): array
    {
        return $this->sendRequest(
            'post', 
            '/instance/create', 
            $this->withDefaultSettings($instanceData)
        )->json();
    }
    
    public function getInstanceStatus(string $instanceId): array
    {
        return $this->sendRequest('get', "/instance/status/$instanceId")->json();
    }

    public function sendTextMessage(string $instanceId, string $number, string $message): array
    {
        return $this->sendRequest('post', "/message/sendText/$instanceId", [
            'number' => $number,
            'textMessage' => ['text' => $message]
        ])->json();
    }

    public function connectInstance(string $instanceId): array
    {
        return $this->sendRequest('post', "/instance/connect/$instanceId")->json();
    }

    public function logoutInstance(string $instanceId): array
    {
        return $this->sendRequest('delete', "/instance/logout/$instanceId")->json();
    }

    private function withDefaultSettings(array $data): array
    {
        return array_merge([
            'integration' => 'WHATSAPP-BAILEYS',
            'webhookBase64' => true,
            'groupsIgnore' => true
        ], $data);
    }
}