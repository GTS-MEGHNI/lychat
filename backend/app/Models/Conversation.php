<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property mixed $latest_message
 * @property mixed $participants
 * @property mixed $id
 * @property mixed $unread_message_count
 */
class Conversation extends Model
{
    use HasFactory;

    protected $table = 'conversations';

    public function subscribers(): HasMany
    {
        return $this->hasMany(ConversationMember::class);
    }

    public function users(): HasManyThrough
    {
        return $this->hasManyThrough(
            User::class,
            UserConversation::class,
            'conversation_id',
            'id',
            'id',
            'user_id'
        );
    }

    public function messages(): HasMany
    {
        return $this->hasMany(ConversationMessage::class);
    }

    public function latestMessage(): HasOne
    {
        return $this->hasOne(ConversationMessage::class)->latest();
    }

    /*
     * export interface Conversation {
  id: number | string
  participants: Array<Participant>
  latestMessage: ConversationMessage
  unreadMessagesCount: number
  createdAt: Date
  avatarUrl: string
  isGroup: boolean
  isMuted: boolean
  isPinned: boolean
  isArchived: boolean
}

     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'participants' => $this->users->toArray(),
            'latestMessage' => $this->latestMessage->toArray(),
            'unreadMessagesCount' => $this->subscribers[0]->number_unread_messages,
            'createdAt' => $this->created_at,
            'avatarUrl' => $this->avatar_url,
            'isGroup' => $this->subscribers[0]->is_group,
            'isMuted' => $this->subscribers[0]->is_muted,
            'isPinned' => $this->subscribers[0]->is_pinned,
            'isArchived' => $this->subscribers[0]->is_archived,
        ];
    }
}
