<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskType extends Model
{
    protected $fillable = [
        'key',
        'name',
        'description',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'type_id');
    }

    public function assignmentRoleConfigs(): HasMany
    {
        return $this->hasMany(TaskTypeAssignmentRoleConfig::class);
    }
}
