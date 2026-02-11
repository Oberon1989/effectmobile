<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class TaskService
{

    public function createTask(string $title, ?string $description, int $status_id): Task
    {
        $task = Task::create([
            'title' => $title,
            'description' => $description,
            'status_id' => $status_id,
        ]);
        return $task->load('status');
    }

    public function getAllTasks(): Collection
    {
        return Task::with('status')->get();
    }

    public function getTaskById($taskId): ?Task
    {
        return Task::with('status')->find($taskId);
    }

    public function updateTask(Task $task, array $data): Task
    {
        $task->update(array_filter($data, fn($v) => !is_null($v)));

        return $task->load('status');
    }

    public function deleteTask(Task $task): void
    {
        $task->delete();
    }
}
