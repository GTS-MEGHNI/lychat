<?php

namespace App;

use Illuminate\Http\JsonResponse;

class Errors
{
    public const INVALID_IMAGE = 'Invalid image';

    public static function wrongPassword(): JsonResponse
    {
        return response()->json(self::apiResponse('error', 'invalid password', []));
    }

    public static function apiResponse(string $status, string $message, mixed $errors): array
    {
        return [
            'status' => $status,
            'message' => $message,
            'errors' => $errors,
        ];
    }
}
