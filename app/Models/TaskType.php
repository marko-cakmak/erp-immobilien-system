<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskType extends Model
{
    protected $fillable = [
        'key',
        'name',
        'description',
    ];

//    public function options()
//    {
//        return $this->hasMany(TaskTypeOption::class);
//    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'type_id');
    }
}
