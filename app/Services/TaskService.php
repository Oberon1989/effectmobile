<?php

namespace App\Services;

use App\Models\Status;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class TaskService
{

    public function createTask(string $title, ?string $description, int $status_id): Task
    {
       return Task::create([
            'title' => $title,
            'description' => $description,
            'status_id' => $status_id,
        ]);
    }
    public function getTaskById($taskId) : ?Task
    {
        return Task::find($taskId);
    }
    public function getAllTasks() : Collection
    {
        return Task::all();
    }

    public function updateTask(Model $task, ?string $title = null, ?string $description = null) : Model
    {
        $task->update(array_filter([
            'name' => $title,
            'description' => $description,
        ]));

        return $task;
    }
    public function deleteTask(Model $task): void
    {
        $task->delete();
    }
}
