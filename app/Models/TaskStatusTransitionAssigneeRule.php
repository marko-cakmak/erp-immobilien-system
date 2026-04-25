<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TaskAssignmentRole;

class TaskStatusTransitionAssigneeRule extends Model
{
    protected $fillable = [
        'transition_id',
        'task_type_id',
        'assignment_role_id',
    ];

    public function transition()
    {
        return $this->belongsTo(TaskStatusTransition::class, 'transition_id');
    }

    public function taskType()
    {
        return $this->belongsTo(TaskType::class, 'task_type_id');
    }

    public function assignmentRole()
    {
        return $this->belongsTo(TaskAssignmentRole::class, 'assignment_role_id');
    }
}
