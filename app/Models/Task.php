<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'type_id',
        'status_id',
        'apartment_id',
        'created_by',
        'message',
        'deadline_at',
        'closed_at',
    ];

    protected $casts = [
        'deadline_at' => 'datetime',
        'closed_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

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

    public function assignees()
    {
        return $this->hasMany(TaskAssignee::class);
    }

    public function activeAssignee()
    {
        return $this->hasOne(TaskAssignee::class)
            ->where('is_active', true);
    }
}
