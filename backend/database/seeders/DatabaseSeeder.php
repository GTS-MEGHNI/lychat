<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Conversation;
use App\Models\ConversationMember;
use App\Models\ConversationMessage;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(2)->create();
        $conversation = Conversation::factory()->create();
        foreach ($users as $user) {
            ConversationMember::factory()->create([
                'user_id' => $user->id,
                'conversation_id' => $conversation->id,
            ]);
            ConversationMessage::factory()->count(5)->create([
                'user_id' => $user->id,
                'conversation_id' => $conversation->id,
            ]);
        }

    }
}
