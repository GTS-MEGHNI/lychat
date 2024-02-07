<?php /** @noinspection PhpUnused */

namespace App\Models;

use App\Utility;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed $id
 * @property mixed $content_type
 * @property mixed $content
 * @property mixed $owner
 * @property mixed $sent_at
 * @property mixed $is_current_user_message
 */
class ConversationMessage extends Model
{
    use HasFactory;

    protected $table = 'conversation_messages';

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->content_type,
            'content' => $this->content,
            'owner' => $this->owner->toArray(),
            'sentAt' => $this->sent_at,
            'isCurrentUserMessage' => $this->is_current_user_message,
        ];
    }

    public function sentAt(): Attribute {
        return new Attribute(
            get:fn($value) => Carbon::parse($value)->format('h:i A')
        );
    }

    public function isCurrentUserMessage():Attribute
    {
        return new Attribute(
            get:fn() => Utility::getUserId() == $this->owner->id
        );
    }

}
