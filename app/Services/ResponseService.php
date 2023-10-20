<?php

namespace App\Services;

class ResponseService
{
    /**
     * Success response.
     *
     * @param mixed $data
     * @param string $message
     * @param int $statusCode
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success($data = [], $message = 'Success', $statusCode = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    /**
     * Respond with an error message.
     *
     * @param string $message
     * @param int $statusCode
     * @param mixed|null $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function error($message = 'Error', $statusCode = 400, $data = null)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }
}
