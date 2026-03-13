<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskTypeOption extends Model
{
    protected $fillable = [
        'task_type_id',
        'key',
        'name',
        'sort_order',
    ];

    public function type()
    {
        return $this->belongsTo(TaskType::class, 'task_type_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
