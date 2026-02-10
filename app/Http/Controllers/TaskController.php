<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends CrudController
{
    protected TaskService $service;

    public function __construct(TaskService $service)
    {
        $this->service = $service;
    }

    public function create(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:30',
            'description' => 'nullable|string|max:255',
            'status_id'   => 'required|integer|exists:statuses,id',
        ]);


        $task = $this->service->createTask(...$validated);

        return response()->json($task, 201);
    }
    public function getAll()
    {
        // TODO: Implement getAll() method.
    }
    public function getById($id) : JsonResponse
    {
        $task = $this->service->getTaskById($id);

        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        return response()->json($task);
    }


    public function update(Request $request, $id) : JsonResponse
    {
        $task = Task::findOrFail($id);
        $validated = $request->validate([
            'title'        => 'sometimes|string|max:30|unique:tasks,title,' . $task->id,
            'description' => 'sometimes|string|max:255',
            'status_id'    => 'sometimes|integer|exists:statuses,id',
        ]);

        $updatedTask = $this->service->updateTask($task, ...$validated);

        return response()->json($updatedTask);
    }

    public function deleteById($id)
    {
        $task = $this->service->getTaskById($id);

        if (!$task) {
            return response()->json(['error' => 'Status not found'], 404);
        }


        $this->service->deleteTask($task);

        return response()->json(null, 204);
    }
}
