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

    public int $conversationId;

    public function __construct(array $conversationMessage, int $conversationId)
    {
        $this->conversationMessage = $conversationMessage;
        $this->conversationId = $conversationId;
    }

    public function broadcastOn(): array
    {
        return ['conversation-'.$this->conversationId];
    }

    /** @noinspection PhpUnused */
    public function broadcastAs(): string
    {
        return 'message-created';
    }
}
