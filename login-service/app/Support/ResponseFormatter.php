<?php

namespace App\Support;

use Illuminate\Support\Carbon;

class ResponseFormatter
{
    /**
     * Format a successful JSON response.
     *
     * @param mixed $data
     * @param string|null $message
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success($data = null, $message = null)
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'server_time' => Carbon::now()->toIso8601String(),
        ], 200);
    }

    /**
     * Format an error JSON response.
     *
     * @param string|null $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public static function error($message = null, $statusCode = 400)
    {
        return response()->json([
            'data' => null,
            'message' => $message,
            'server_time' => Carbon::now()->toIso8601String(),
        ], $statusCode);
    }
}
