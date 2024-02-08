<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ConversationService;
use Illuminate\Http\JsonResponse;

class ConversationController extends Controller
{
    public function list(User $user, ConversationService $service): JsonResponse
    {
        return response()->json($service->getConversationsByUser($user));
    }
}
