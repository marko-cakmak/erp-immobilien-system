<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepairType extends Model
{
    protected $fillable = [
        'key',
        'name',
        'sort_order',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }
}
