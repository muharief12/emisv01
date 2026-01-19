<?php

namespace App\Service;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class WahaService
{
    protected string $baseUrl;
    protected string $apiKey;
    protected string $session;

    public function __construct()
    {
        $this->baseUrl = config('services.waha.base_url', 'http://localhost:3000');
        $this->apiKey  = config('services.waha.api_key');
        $this->session = config('services.waha.session');
    }

    public function sendMessage(string $chatId, string $text): array
    {
        /** @var Response $response */
        $response = Http::withHeaders([
            'x-api-key' => $this->apiKey,
            'accept' => 'appication/json'
        ])->post("{$this->baseUrl}/api/sendText", [
            'chatId' => $chatId,
            'text' => $text,
            'session' => $this->session
        ]);

        if (!$response->successful()) {
            throw new \Exception('WAHA API error' . $response->body());
        }

        return [
            'success' => false,
            'status' => $response->status(),
            'error' => $response->body(),
        ];
    }
}
