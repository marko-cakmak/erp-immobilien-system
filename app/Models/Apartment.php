<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = [
        'title',
        'internal_number',
        'street_address',
        'postal_code',
        'city',
        'state',
        'floor',
        'rooms',
        'size_sqm',
        'year_built',
        'rent_cold',
        'rent_warm',
        'deposit',
        'apartment_status_id',
        'notes',
        'is_active',
    ];

    /**
     * Apartment status
     */
    public function status()
    {
        return $this->belongsTo(ApartmentStatus::class, 'apartment_status_id');
    }

    /**
     * Apartment images
     */
    public function images()
    {
        return $this->hasMany(ApartmentImage::class)
            ->orderBy('position');
    }

    /**
     * Cover image
     */
    public function coverImage()
    {
        return $this->hasOne(ApartmentImage::class)
            ->where('is_cover', true);
    }
}
