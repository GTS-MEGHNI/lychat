<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserConnected implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public int $conversationId, public int $userId)
    {
        //
    }

    public function broadcastOn(): array
    {
        return ['conversation-'.$this->conversationId];
    }

    /** @noinspection PhpUnused */
    public function broadcastAs(): string
    {
        return 'conversation-active';
    }
}
