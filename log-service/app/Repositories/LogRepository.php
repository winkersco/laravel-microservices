<?php

namespace App\Repositories;

use App\Models\Log;
use Illuminate\Support\Collection;

class LogRepository implements LogRepositoryInterface
{
    public function create(array $data): Log
    {
        return Log::create($data);
    }

    public function findByService($serviceName, $limit = 10, $filters = []): Collection
    {
        $query = Log::query();

        $query->where('service_name', $serviceName);
        foreach ($filters as $key => $value) {
            $query->where($key, $value);
        }
        $query->limit($limit);
        $query->latest();

        return $query->get();
    }
}
