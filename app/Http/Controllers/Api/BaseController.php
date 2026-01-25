<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class BaseController extends Controller
{
    public function sendResponse($result, $message, $code = 200): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'status_code' => $code,
            'message' => $message,
            'data' => $result,
            'error_note' => null
        ], $code);
    }

    public function sendError($error, $errorMessages = [], $code = 404, $note = null): JsonResponse
    {
        $response = [
            'status' => 'error',
            'status_code' => $code,
            'error_message' => $error,
            'error_note' => $note,
        ];

        if (!empty($errorMessages)) {
            $response['errors'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
