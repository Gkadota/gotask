<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $mainUserID = User::where('email', 'johndoe@gmail.com')->pluck('id')->first();
        return [
            'body' => fake()->sentence(4),
            'user_id' => $mainUserID,
            'task_id' => Task::factory()
        ];
    }
}
