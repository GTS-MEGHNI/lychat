<?php

namespace Database\Factories;

use App\Dictionary;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConversationMessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content_type' => Dictionary::TEXT_CONTENT,
            'content' => $this->faker->sentence(),
        ];
    }
}
