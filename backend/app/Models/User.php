<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * @method static find(int $id)
 * @method static where(string $string, string $string1, int $int)
 * @method static count()
 * @method static findByEmail(string $email)
 *
 * @property mixed $conversations
 * @property mixed $id
 * @property mixed $password
 */
class User extends Model
{
    use HasFactory;

    /** @noinspection PhpUnused */
    public function scopeFindByEmail(mixed $query, string $email)
    {
        return $query->where(['email' => $email])->first();
    }

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
            get: fn ($value) => env('APP_URL').'/users/'.$value
        );
    }
}
