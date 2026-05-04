<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContractStatus extends Model
{
    protected $fillable = [
        'key',
        'name',
        'color',
        'sort_order',
    ];

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class, 'contract_status_id');
    }
}
