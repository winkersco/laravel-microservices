<?php

namespace App\Http\Controllers;

use App\Facades\ResponseFormatter;
use App\Services\LogService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class GetRecentLoginLogsController extends Controller
{

    public function __construct(
        protected readonly LogService $logService
    ) {}

    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $logs = $this->logService->getRecentLoginLogs(
            'login',
            $request->query('limit', -1),
            [
                'identifier' => $request->user()->mobile,
                'type' => 'login'
            ]
        );

        return ResponseFormatter::success($logs);
    }
}
