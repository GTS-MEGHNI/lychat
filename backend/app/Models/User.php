<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
/**
 * @method static find(int $id)
 * @property mixed $conversations
 */
class User extends Model
{
    use HasFactory;


    public function conversations(): HasManyThrough
    {
        return $this->hasManyThrough(
            Conversation::class,
            UserConversation::class,
            'user_id',
            'id',
            'id',
            'conversation_id'
        );
    }

    /** @noinspection PhpUnused */
    public function avatar(): Attribute
    {
        return new Attribute(
            get: fn ($value) => env('APP_URL') . '/users/' . $value
        );
    }
}
