<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterestedPerson extends Model
{
    protected $table = 'interested_persons';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'street_address',
        'postal_code',
        'city',
        'notes',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Full name accessor
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Apartments this person is interested in
     */
    public function apartments()
    {
        return $this->belongsToMany(Apartment::class, 'apartment_interests')
            ->withTimestamps();
    }

    /**
     * Interest records
     */
    public function interests()
    {
        return $this->hasMany(ApartmentInterest::class);
    }
}
