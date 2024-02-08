<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversationMember extends Model
{
    use HasFactory;

    protected $table = 'conversation_members';

    protected $casts = [
        'is_group' => 'boolean',
        'is_muted' => 'boolean',
        'is_pinned' => 'boolean',
        'is_archived' => 'boolean',
    ];
}
