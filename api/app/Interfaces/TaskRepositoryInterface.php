<?php
namespace App\Interfaces;

interface TaskRepositoryInterface {
    public function createTask(array $taskDetails);

    public function updateTask($taskId, array $taskDetails);

    public function deleteTask($taskId);

    public function getTasks($assigneeId);

    public function getTasksById($taskId);

    public function searchTask($assigneeId, $term);
}
