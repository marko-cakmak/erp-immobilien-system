<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contract extends Model
{
    protected $fillable = [
        'apartment_id',
        'interested_person_id',
        'contract_status_id',
        'created_by',
        'start_date',
        'end_date',
        'notes',
        'signed_at',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'signed_at' => 'datetime',
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(ContractStatus::class, 'contract_status_id');
    }

    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }

    public function interestedPerson(): BelongsTo
    {
        return $this->belongsTo(InterestedPerson::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function isSigned(): bool
    {
        return !is_null($this->signed_at);
    }
}
