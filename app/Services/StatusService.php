<?php

namespace App\Services;

use App\Models\Entity;
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
    public function getStatusById($statusId) : ?Status
    {
        return Status::find($statusId);
    }
    public function getAllStatus() : Collection
    {
        return Status::all();
    }

    public function updateStatus(Status $status, ?string $name = null, ?string $description = null): Model
    {

        $status->update(array_filter([
            'name' => $name,
            'description' => $description,
        ]));

        return $status;
    }

    public function deleteStatus(Status $status) : void
    {
        $status->delete();
    }
}
