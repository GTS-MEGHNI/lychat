<?php

namespace App\Services;

use App\Dictionary;
use App\Http\Resources\ConversationResource;
use App\Models\Conversation;
use App\Models\ConversationMessage;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;

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
                'content' => $payload['type'] == Dictionary::TEXT_CONTENT ?
                    $payload['content']
                    :
                    $this->getImageFileName($payload['content'], $conversation),
            ]);
        }
    }

    public function getCreatedMessage(): ConversationMessage
    {
        return $this->conversationMessage;
    }

    public function getImageFileName(string $content, Conversation $conversation): string
    {
        $decodedString = base64_decode($content);
        $mime = explode('/', getimagesizefromstring($decodedString)['mime'])[1];
        $directory = $conversation->id.'/';
        $filename = uniqid().'.'.$mime;
        Storage::disk('conversations')->put($directory.$filename, $decodedString);

        return $filename;
    }
}
