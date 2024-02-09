<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $conversationMessage;

    public int $conversation_id;

    public function __construct(array $conversationMessage, int $conversation_id)
    {
        $this->conversationMessage = $conversationMessage;
        $this->conversation_id = $conversation_id;
    }

    public function broadcastOn(): array
    {
        return ['conversation-'.$this->conversation_id];
    }

    /** @noinspection PhpUnused */
    public function broadcastAs(): string
    {
        return 'message-created';
    }
}
