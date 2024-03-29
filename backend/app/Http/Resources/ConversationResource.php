<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $latest_message
 * @property mixed $participants
 * @property mixed $id
 * @property mixed $unread_message_count
 * @property mixed $users
 * @property mixed $latestMessage
 * @property mixed $avatar_url
 * @property mixed $subscribers
 * @property mixed $messages
 * @property mixed $title
 */
class ConversationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'participants' => UserResource::collection($this->users),
            'latestMessage' => new ConversationMessageResource($this->latestMessage),
            'unreadMessagesCount' => $this->subscribers[0]->number_unread_messages,
            'avatarUrl' => $this->avatar_url,
            'isGroup' => $this->subscribers[0]->is_group,
            'isMuted' => $this->subscribers[0]->is_muted,
            'isPinned' => $this->subscribers[0]->is_pinned,
            'isArchived' => $this->subscribers[0]->is_archived,
            'isActive' => false,
        ];
    }

    public function toArrayWithMessages(): array
    {
        return [
            ...$this->toArray(request()),
            'messages' => ConversationMessageResource::collection($this->messages),
        ];
    }
}
