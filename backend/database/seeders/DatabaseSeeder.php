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
        $users = User::factory()->count(3)->create();
        $conversations = Conversation::factory()->count(2)->create();
        foreach ($conversations as $conversation) {
            $randomUserId = User::where('id', '!=', 1)->inRandomOrder()->first()->id;
            ConversationMember::factory()->create([
                'user_id' => 1,
                'conversation_id' => $conversation->id,
            ]);
            ConversationMember::factory()->create([
                'user_id' => $randomUserId,
                'conversation_id' => $conversation->id,
            ]);
            ConversationMessage::factory()->count(2)->create([
                'user_id' => 1,
                'conversation_id' => $conversation->id,
            ]);
            ConversationMessage::factory()->count(2)->create([
                'user_id' => $randomUserId,
                'conversation_id' => $conversation->id,
            ]);
        }

    }
}
