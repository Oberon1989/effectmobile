<?php

namespace App\Services;

use App\Models\Status;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class StatusService
{

    public function createStatus(string $name, ?string $description): Status
    {
        return Status::create([
            'name' => $name,
            'description' => $description,
        ]);
    }

    public function getAllStatus(): Collection
    {
        return Status::all();
    }

    public function getStatusById($statusId): ?Status
    {
        return Status::find($statusId);
    }

    public function updateStatus(Status $status, array $data): Status
    {
        $status->update(array_filter($data, fn($v) => !is_null($v)));

        return $status;
    }

    public function deleteStatus(Status $status): void
    {
        $status->delete();
    }
}
