<?php

namespace App\Observers;

use App\Events\MessageCreated;
use App\Http\Resources\ConversationMessageResource;
use App\Models\ConversationMessage;

class ConversationMessageObserver
{
    /**
     * Handle the ConversationMessage "created" event.
     */
    public function created(ConversationMessage $conversationMessage): void
    {
        $resource = new ConversationMessageResource($conversationMessage);
        event(new MessageCreated(
            json_decode($resource->toJson(), true),
            $conversationMessage->conversation->id)
        );
    }

    /**
     * Handle the ConversationMessage "updated" event.
     */
    public function updated(ConversationMessage $conversationMessage): void
    {
        //
    }

    /**
     * Handle the ConversationMessage "deleted" event.
     */
    public function deleted(ConversationMessage $conversationMessage): void
    {
        //
    }

    /**
     * Handle the ConversationMessage "restored" event.
     */
    public function restored(ConversationMessage $conversationMessage): void
    {
        //
    }

    /**
     * Handle the ConversationMessage "force deleted" event.
     */
    public function forceDeleted(ConversationMessage $conversationMessage): void
    {
        //
    }
}
