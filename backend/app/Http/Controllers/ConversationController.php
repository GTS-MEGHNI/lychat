<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\User;
use App\Services\ConversationService;
use Illuminate\Http\JsonResponse;

class ConversationController extends Controller
{
    public function list(User $user, ConversationService $service): JsonResponse
    {
        return response()->json($service->getConversationsByUser($user));
    }

    /** @noinspection PhpUnusedParameterInspection */
    public function get(User $user, Conversation $conversation, ConversationService $service): JsonResponse
    {
        return response()->json($service->getConversation($conversation));
    }
}
