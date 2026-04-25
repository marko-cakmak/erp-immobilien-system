<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskAssignmentRole extends Model
{
    protected $fillable = [
        'key',
        'name',
    ];

    public function assignees(): HasMany
    {
        return $this->hasMany(TaskAssignee::class, 'assignment_role_id');
    }

    public function transitionRules(): HasMany
    {
        return $this->hasMany(TaskStatusTransitionAssigneeRule::class, 'assignment_role_id');
    }
}
