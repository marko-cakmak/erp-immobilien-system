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

    public function status()
    {
        return $this->belongsTo(ApartmentStatus::class, 'apartment_status_id');
    }

    public function images()
    {
        return $this->hasMany(ApartmentImage::class)
            ->orderBy('position');
    }

    public function coverImage()
    {
        return $this->hasOne(ApartmentImage::class)
            ->where('is_cover', true);
    }

    public function interestedPersons()
    {
        return $this->belongsToMany(InterestedPerson::class, 'apartment_interests')
            ->withTimestamps();
    }

    public function interests()
    {
        return $this->hasMany(ApartmentInterest::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class)
            ->with(['type', 'status', 'activeAssignee.user'])
            ->latest();
    }
}
