<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConversationMessage extends Model
{
    use HasFactory;

    protected $table = 'conversation_messages';

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->content_type,
            'content' => $this->content,
            'owner' => $this->owner->toArray(),
            'sentAt' => $this->sent_at,
            'isCurrentUserMessage' => $this->is_current_user_message,
        ];
    }
}
