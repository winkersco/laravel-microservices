<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class LogService
{
    protected $host;
    protected $port;
    protected $url;

    public function __construct()
    {
        $this->host = config('services.log-service.host');
        $this->port = config('services.log-service.port');
        $this->url = "http://{$this->host}:{$this->port}";
    }

    public function getRecentLoginLogs(string $serviceName, int $limit = 10, array $filters = []): Collection
    {
        $params = array_merge([
            'service_name' => $serviceName,
            'limit' => $limit,
        ], $filters);

        $response = Http::get("{$this->url}/api/logs", $params);

        if ($response->failed()) {
            throw new Exception('Service is not available.');
        }

        return collect($response->json('data'))->map(function ($log) {
            return $log['context']['datetime'] ?? null;
        })->filter();
    }
}
