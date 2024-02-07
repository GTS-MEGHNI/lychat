<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class ConversationController extends Controller
{
    /** @noinspection PhpUndefinedFieldInspection */
    public function list(int $userId): JsonResponse
    {
        return response()->json(User::with(['conversations.subscribers' => function ($query) use ($userId) {
            $query->where(['user_id' => $userId]);
        }])->find($userId)->conversations?->toArray());
    }
}
