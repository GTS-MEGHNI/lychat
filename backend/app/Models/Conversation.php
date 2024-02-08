<?php

namespace App\Models;

use App\Utility;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property mixed $subscribers
 * @property mixed $users
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
        return $this->hasMany(ConversationMessage::class)->oldest('id');
    }

    /** @noinspection PhpUnused */
    public function latestMessage(): HasOne
    {
        return $this->hasOne(ConversationMessage::class)->latest('id');
    }

    /** @noinspection PhpUnused */
    public function avatarUrl(): Attribute
    {
        return new Attribute(
            get: function () {
                if ($this->users->count() == 2) {
                    return $this->users->where('id', '!=', Utility::getUserId())->first()->avatar;
                } else {
                    return null;
                }
            }
        );
    }

    public function title(): Attribute
    {
        return new Attribute(
            get: function () {
                if ($this->users->count() == 2) {
                    return $this->users->where('id', '!=', Utility::getUserId())->first()->username;
                } else {
                    return null;
                }
            }
        );
    }
}
