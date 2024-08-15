<?php

namespace App\Http\Controllers;

use App\Facades\ResponseFormatter;
use App\Http\Requests\LogFilterRequest;
use App\Services\LogService;

class LogController extends Controller
{
    public function __construct(
        protected readonly LogService $logService
    ) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(LogFilterRequest $request)
    {
        $serviceName = $request->validated('service_name');
        $limit = $request->validated('limit', 10);
        $filters = $request->validated('filters', []);

        $logs = $this->logService->getByService($serviceName, $limit, $filters);

        return ResponseFormatter::success($logs);
    }
}
