<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /*
    |--------------------------------------------------------------------------
    | Mass Assignment
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'type_id',
//        'task_type_option_id',
        'status_id',
        'apartment_id',
        'created_by',
        'message',
        'deadline_at',
        'closed_at',
    ];

    /*
    |--------------------------------------------------------------------------
    | Casts
    |--------------------------------------------------------------------------
    */

    protected $casts = [
        'deadline_at' => 'datetime',
        'closed_at'   => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // --- Core relations

    public function type()
    {
        return $this->belongsTo(TaskType::class);
    }

    public function status()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // --- Assignees

    public function assignees()
    {
        return $this->hasMany(TaskAssignee::class);
    }

    public function activeAssignee()
    {
        return $this->hasOne(TaskAssignee::class)
            ->where('is_active', true);
    }

    // --- Besichtigung

    public function besichtigung()
    {
        return $this->hasOne(Besichtigung::class);
    }

    // --- Options
//    public function option()
//    {
//        return $this->belongsTo(TaskTypeOption::class, 'task_type_option_id');
//    }

    public function repair()
    {
        return $this->hasOne(Repair::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods (Optional Domain Logic)
    |--------------------------------------------------------------------------
    */

    public function isClosed(): bool
    {
        return !is_null($this->closed_at);
    }

    public function isAssignedTo(int $userId): bool
    {
        return $this->activeAssignee?->user_id === $userId;
    }
}
