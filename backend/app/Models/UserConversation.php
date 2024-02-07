<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserConversation extends Pivot
{
    use HasFactory;

    protected $table = 'conversation_members';
}
