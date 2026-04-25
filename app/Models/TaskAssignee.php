<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\TaskAssignmentRole;

class TaskAssignee extends Model
{
    protected $fillable = [
        'task_id',
        'user_id',
        'assignment_role_id',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function assignmentRole(): BelongsTo
    {
        return $this->belongsTo(TaskAssignmentRole::class, 'assignment_role_id');
    }
}
