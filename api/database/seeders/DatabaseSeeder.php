<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //create 5 random users
        User::factory()
            ->count(5)
            ->create();
            
        // create specific user for testing
        User::factory()
            ->create([
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    'email' => 'johndoe@gmail.com',
            ]);

        // create 10 task for test user
        Task::factory()
            ->count(10)
            ->create();

        // create 10 comments randomly for test user's tasks
        Comment::factory()
            ->count(10)
            ->create();
    }
}
