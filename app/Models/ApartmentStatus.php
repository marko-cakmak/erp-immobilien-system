<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApartmentStatus extends Model
{
    protected $fillable = [
        'code',
        'label',
        'color',
        'sort_order',
        'is_active',
    ];

    public function apartments()
    {
        return $this->hasMany(Apartment::class);
    }
}
