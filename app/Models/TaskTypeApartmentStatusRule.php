<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskTypeApartmentStatusRule extends Model
{
    protected $fillable = [
        'task_type_id',
        'task_status_id',
        'apartment_status_id',
    ];

    public function taskType()
    {
        return $this->belongsTo(TaskType::class);
    }

    public function taskStatus()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function apartmentStatus()
    {
        return $this->belongsTo(ApartmentStatus::class);
    }
}
