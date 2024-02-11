<?php

/** @noinspection PhpUnused */

namespace App\Models;

use App\Dictionary;
use App\Utility;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed $owner
 * @property mixed $conversation
 * @property mixed $content_type
 * @property mixed $created_at
 * @property mixed $conversation_id
 * @property mixed $file_name
 * @property mixed $file_size
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
        'file_name',
        'file_size',
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
            get: fn ($value) => $this->created_at->format('h:i A')
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
            get: function ($value) {
                return match ($this->content_type) {
                    Dictionary::TEXT_CONTENT => $value,
                    Dictionary::IMAGE_CONTENT => env('APP_URL').'/conversations/'.$this->conversation_id.'/'.$value,
                    Dictionary::FILE_CONTENT => [
                        'name' => $this->file_name,
                        'size' => $this->file_size,
                        'url' => env('APP_URL').'/conversations/'.$this->conversation_id.'/'.$value,
                    ]
                };
            }
        );
    }
}
