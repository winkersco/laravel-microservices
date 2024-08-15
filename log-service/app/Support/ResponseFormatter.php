<?php

namespace App\Support;

use Illuminate\Support\Carbon;

class ResponseFormatter
{
    /**
     * Format a successful JSON response.
     *
     * @param mixed $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success($data = null, $statusCode = 200)
    {
        return response()->json([
            'data' => $data,
            'server_time' => Carbon::now()->toIso8601String(),
        ], $statusCode);
    }

    /**
     * Format an error JSON response.
     *
     * @param string|null $data
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public static function error($data = null, $statusCode = 400)
    {
        return response()->json([
            'data' => $data,
            'server_time' => Carbon::now()->toIso8601String(),
        ], $statusCode);
    }
}
