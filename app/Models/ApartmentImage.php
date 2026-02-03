<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApartmentImage extends Model
{
    protected $fillable = [
        'apartment_id',
        'path',
        'position',
        'is_cover',
    ];

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}
