<?php

namespace App\Services;

use App\Http\Resources\ConversationResource;
use App\Models\Conversation;
use App\Models\ConversationMessage;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ConversationService
{
    private ConversationMessage $conversationMessage;

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

    public function addMessage(array $payload, User $user, Conversation $conversation): void
    {
        if ($user->conversations->find($conversation->id) != null) {
            $this->conversationMessage = ConversationMessage::create([
                'conversation_id' => $conversation->id,
                'user_id' => $user->id,
                'content_type' => $payload['type'],
                'content' => $payload['content'],
            ]);
        }
    }

    public function getCreatedMessage(): ConversationMessage
    {
        return $this->conversationMessage;
    }
}
