<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
/**
 * @property mixed $id
 * @property mixed $content_type
 * @property mixed $content
 * @property mixed $owner
 * @property mixed $sent_at
 * @property mixed $is_current_user_message
 */
class ConversationMessageResource extends JsonResource
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
            'type' => $this->content_type,
            'content' => $this->content,
            'owner' => new UserResource($this->owner),
            'sentAt' => $this->sent_at,
            'isCurrentUserMessage' => $this->is_current_user_message,
        ];
    }
}
