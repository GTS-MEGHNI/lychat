<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddMessageRequest;
use App\Http\Resources\ConversationMessageResource;
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

    public function addMessage(AddMessageRequest $request, User $user, Conversation $conversation, ConversationService $service): JsonResponse
    {
        $service->addMessage($request->validated(), $user, $conversation);

        return response()->json(new ConversationMessageResource($service->getCreatedMessage()), 201);
    }
}
