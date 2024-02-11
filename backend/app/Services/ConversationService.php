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

    private Conversation $conversation;

    private array $payload;

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
        $this->conversation = $conversation;
        $this->payload = $payload;

        if ($user->conversations->find($conversation->id) != null) {
            $this->conversationMessage = ConversationMessage::create([
                'conversation_id' => $conversation->id,
                'user_id' => $user->id,
                'content_type' => $payload['type'],
                'content' => $this->getContentData(),
                'file_name' => $payload['type'] == Dictionary::FILE_CONTENT ? $payload['content']['name'] : null,
                'file_size' => $payload['type'] == Dictionary::FILE_CONTENT ? request()->request->get('size') : null,
            ]);
        }
    }

    private function getContentData(): string
    {
        return match ($this->payload['type']) {
            Dictionary::TEXT_CONTENT => $this->payload['content'],
            Dictionary::IMAGE_CONTENT => $this->getStoredImageFileName(),
            Dictionary::FILE_CONTENT => $this->getStoredFileName()
        };
    }

    public function getCreatedMessage(): ConversationMessage
    {
        return $this->conversationMessage;
    }

    private function getStoredImageFileName(): string
    {
        $decodedString = base64_decode($this->payload['content']);
        $mime = explode('/', getimagesizefromstring($decodedString)['mime'])[1];
        $directory = $this->conversation->id.'/';
        $filename = uniqid().'.'.$mime;
        Storage::disk('conversations')->put($directory.$filename, $decodedString);

        return $filename;
    }

    private function getStoredFileName(): string
    {
        $decodedString = base64_decode($this->payload['content']['base64']);
        $fileType = request()->request->get('mime');
        $directory = $this->conversation->id.'/';
        $mime = match ($fileType) {
            Dictionary::FILE_AUDIO_TYPE => 'mp3',
            Dictionary::FILE_TEXT_TYPE => 'txt'
        };
        $filename = uniqid().'.'.$mime;
        Storage::disk('conversations')->put($directory.$filename, $decodedString);

        return $filename;
    }
}
