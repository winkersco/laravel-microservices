<?php

namespace App\Services;

use App\Models\Log;
use App\Repositories\LogRepositoryInterface;

class LogService
{
    public function __construct(
        protected readonly LogRepositoryInterface $logRepository,
    ) {}

    public function create(array $data): Log
    {
        return $this->logRepository->create($data);
    }

    public function getByService($serviceName, $limit = 10, $filters = [])
    {
        return $this->logRepository->findByService($serviceName, $limit, $filters);
    }
}
