<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\ShowTaskRequest;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Interfaces\TaskRepositoryInterface;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    private TaskRepositoryInterface $taskRepo;

    public function __construct(TaskRepositoryInterface $taskRepo)
    {
        $this->taskRepo = $taskRepo;
    }
    /**
     * Display specific task
     */
    public function index(ShowTaskRequest $request)
    {
        $tasks =  $this->taskRepo->getTasksById($request->route('id'));
        return response()->json($tasks);
    }


    /**
     * Display a listing of task by assignee .
     */
    public function list(ShowTaskRequest $request)
    {
        $tasks =  $this->taskRepo->getTasks($request->assignee_id);
        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $newTask =  $this->taskRepo->createTask([
             'title' => $request->title,
         'description' => $request->description,
         'due_date' => $request->due_date,
         'assignee_id' => $request->assignee_id,
         'creator_id' => $request->creator_id,
         'priority' => $request->priority,
         'status' => $request->status,
         'category' => $request->category
         ]);

        return response()->json($newTask, Response::HTTP_CREATED);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request)
    {

        $isTaskUpdated = $this->taskRepo->updateTask($request->taskId, $request->tasks);
        return response()->json(['success' => (bool) $isTaskUpdated]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UpdateTaskRequest $request)
    {
        $isTaskDeleted =  $this->taskRepo->deleteTask($request->id);
        return response()->json(['success' => (bool) $isTaskDeleted]);
    }
}
