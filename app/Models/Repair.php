<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    protected $fillable = [
        'task_id',
        'repair_type_id',
        'notes',
        'priority',
        'estimated_cost',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function type()
    {
        return $this->belongsTo(RepairType::class, 'repair_type_id');
    }

    public function images()
    {
        return $this->hasMany(RepairImage::class);
    }
}
