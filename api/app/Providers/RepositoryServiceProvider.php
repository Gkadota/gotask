<?php

namespace App\Providers;

use App\Interfaces\CommentRepositoryInterface;
use App\Interfaces\TaskRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\TaskRepository;
use App\Repositories\CommentRepository;
use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
