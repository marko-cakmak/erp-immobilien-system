<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskStatusTransition extends Model
{
    protected $fillable = [
        'from_status_id',
        'to_status_id',
    ];

    public function fromStatus()
    {
        return $this->belongsTo(TaskStatus::class, 'from_status_id');
    }

    public function toStatus()
    {
        return $this->belongsTo(TaskStatus::class, 'to_status_id');
    }

    public function assigneeRule()
    {
        return $this->hasOne(TaskStatusTransitionAssigneeRule::class, 'transition_id');
    }
}
