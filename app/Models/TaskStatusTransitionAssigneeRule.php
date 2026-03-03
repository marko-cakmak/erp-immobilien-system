<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskStatusTransitionAssigneeRule extends Model
{
    protected $fillable = [
        'transition_id',
        'task_type_id',
        'activate_role_id',
    ];

    public function transition()
    {
        return $this->belongsTo(TaskStatusTransition::class, 'transition_id');
    }

    public function taskType()
    {
        return $this->belongsTo(TaskType::class, 'task_type_id');
    }

    public function activateRole()
    {
        return $this->belongsTo(Role::class, 'activate_role_id');
    }
}
