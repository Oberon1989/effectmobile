<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected  $fillable = [
        'title',
        'description',
        'status_id',
    ];

    public function status() : BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

}


