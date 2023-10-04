<?php

namespace App\Repositories;

use App\Interfaces\TaskRepositoryInterface;
use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
    public function createTask(array $taskDetails)
    {
        return Task::create($taskDetails);
    }

    public function updateTask($taskId, array $updatedTask)
    {
        return Task::whereId($taskId)->update($updatedTask);
    }

    public function deleteTask($taskId)
    {
        return Task::destroy($taskId);
    }

    public function getTasks($assigneeId = null)
    {
        return Task::where('assignee_id', $assigneeId)
        ->orderBy('created_at', 'desc')
        ->get();
    }

    public function searchTask($assigneeId, $term)
    {
        return Task::where('title', 'Like', '%' .  $term . '%')
            ->where('assignee_id', $assigneeId)
            ->get();
    }

    public function getTasksById($taskId)
    {
        return Task::with('comments', 'comments.user')
            ->with('assignee')
            ->with('creator')
            ->find($taskId);
    }


    
}
