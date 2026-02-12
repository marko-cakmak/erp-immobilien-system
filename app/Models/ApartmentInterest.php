<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApartmentInterest extends Model
{
    protected $fillable = [
        'interested_person_id',
        'apartment_id',
    ];

    /**
     * Interested person
     */
    public function interestedPerson()
    {
        return $this->belongsTo(InterestedPerson::class);
    }

    /**
     * Apartment
     */
    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}
