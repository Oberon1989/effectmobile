<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CrudController;
use App\Models\Status;
use App\Services\StatusService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StatusController extends CrudController
{

    protected StatusService $service;

    public function __construct(StatusService $service)
    {
        $this->service = $service;
    }

    public function create(Request $request) : JsonResponse
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:30',
            'description' => 'nullable|string|max:255',
        ]);


        $task = $this->service->createStatus(...$validated);

        return response()->json($task, 201);
    }

    public function getAll() : JsonResponse
    {
        return response()->json($this->service->getAllStatus());
    }

    public function getById($id)
    {
        $status = $this->service->getStatusById($id);

        if (!$status) {
            return response()->json(['error' => 'Status not found'], 404);
        }

        return response()->json($status);
    }


    public function update(Request $request, $id): JsonResponse
    {
        $status = Status::findOrFail($id);

        $validated = $request->validate([
            'name'        => 'sometimes|string|max:30|unique:statuses,name,' . $status->id,
            'description' => 'sometimes|string|max:255',
        ]);

        $updatedStatus = $this->service->updateStatus($status, ...$validated);

        return response()->json($updatedStatus);
    }

    public function deleteById($id): JsonResponse
    {
        $status = $this->service->getStatusById($id);

        if (!$status) {
            return response()->json(['error' => 'Status not found'], 404);
        }

        if ($status->tasks()->exists())
        {
            return response()->json(['error' => 'Cannot delete status with tasks'], 422);
        }


        $this->service->deleteStatus($status);

        return response()->json(null, 204);
    }
}
