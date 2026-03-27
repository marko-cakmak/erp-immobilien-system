<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskTypeAssignmentRoleConfig extends Model
{
    protected $table = 'task_type_assignment_role_config';

    protected $fillable = [
        'task_type_id',
        'assignment_role_id',
        'is_active_on_creation',
    ];

    protected $casts = [
        'is_active_on_creation' => 'boolean',
    ];

    public function taskType(): BelongsTo
    {
        return $this->belongsTo(TaskType::class);
    }

    public function assignmentRole(): BelongsTo
    {
        return $this->belongsTo(TaskAssignmentRole::class);
    }
}
