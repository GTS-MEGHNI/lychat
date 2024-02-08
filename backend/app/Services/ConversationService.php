<?php

namespace App\Services;

use App\Http\Resources\ConversationResource;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ConversationService
{
    /** @noinspection PhpPossiblePolymorphicInvocationInspection */
    public function getConversationsByUser(User $user): AnonymousResourceCollection|array
    {
        $userId = $user->id;
        $conversations = User::with(['conversations.subscribers' => function ($query) use ($userId) {
            $query->where(['user_id' => $userId]);
        }])->find($userId)->conversations;

        return $conversations != null ? ConversationResource::collection($conversations) : [];
    }

    public function getConversation(Conversation $conversation): array
    {
        return (new ConversationResource($conversation))->toArrayWithMessages();
    }
}
