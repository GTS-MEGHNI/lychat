<?php

namespace App\Services;

use App\Http\Resources\ConversationResource;
use App\Models\User;

class ConversationService {


    /** @noinspection PhpPossiblePolymorphicInvocationInspection */
    public function getConversationsByUser(User $user)
    {
        $userId = $user->id;
        $conversations = User::with(['conversations.subscribers' => function ($query) use ($userId) {
            $query->where(['user_id' => $userId]);
        }])->find($userId)->conversations;
        return $conversations != null ? ConversationResource::collection($conversations) : [];
    }
}
