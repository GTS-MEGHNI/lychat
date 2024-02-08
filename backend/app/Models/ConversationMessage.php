<?php /** @noinspection PhpUnused */

namespace App\Models;

use App\Utility;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * @property mixed $owner
 */
class ConversationMessage extends Model
{
    use HasFactory;

    protected $table = 'conversation_messages';

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
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
