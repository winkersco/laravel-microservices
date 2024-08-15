<?php

namespace App\Repositories;

use App\Models\Log;
use Illuminate\Support\Collection;

interface LogRepositoryInterface
{
    public function create(array $data): Log;
    public function findByService($serviceName, $limit = 10, $filters = null): Collection;
}
