<?php

/** @noinspection PhpUnused */

namespace App\Models;

use App\Dictionary;
use App\Utility;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed $owner
 * @property mixed $conversation
 * @property mixed $content_type
 *
 * @method static create(array $array)
 */
class ConversationMessage extends Model
{
    use HasFactory;

    protected $table = 'conversation_messages';

    protected $fillable = [
        'content_type',
        'content',
        'user_id',
        'conversation_id',
    ];

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sentAt(): Attribute
    {
        return new Attribute(
            get: fn ($value) => Carbon::parse($value)->format('h:i A')
        );
    }

    public function isCurrentUserMessage(): Attribute
    {
        return new Attribute(
            get: fn () => Utility::getUserId() == $this->owner->id
        );
    }

    public function content(): Attribute
    {
        return new Attribute(
            get: fn ($value) => $this->content_type == Dictionary::IMAGE_CONTENT ?
                env('APP_URL').'/conversations/'.$this->conversation_id.'/'.$value
                :
                $value
        );
    }
}
