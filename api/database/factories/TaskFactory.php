<?php

namespace Database\Factories;

use App\Models\User;
use App\Support\Constant\AppConstant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
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
        'title'       => fake()->sentence(4),
        'description' => fake()->sentence(),
        'due_date'    => fake()->dateTimeThisYear('+3 months'),
        'priority'    => fake()->randomElement(AppConstant::PRIORITIES),
        'status'      => fake()->randomElement(AppConstant::TASK_STATUSES),
        'category'    => fake()->randomElement(AppConstant::CATEGORIES),
        'assignee_id' => $mainUserID,
        'creator_id' => User::factory(),
        ];
    }
}
