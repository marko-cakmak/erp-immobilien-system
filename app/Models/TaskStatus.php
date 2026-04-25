<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    protected $fillable = [
        'key',
        'name',
        'color',
        'sort_order',
    ];

    public function allowedTransitions()
    {
        return $this->belongsToMany(
            TaskStatus::class,
            'task_status_transitions',
            'from_status_id',
            'to_status_id'
        )->orderBy('sort_order');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'status_id');
    }
}
