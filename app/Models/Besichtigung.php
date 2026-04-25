<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Besichtigung extends Model
{
    protected $table = 'besichtigungen';

    protected $fillable = [
        'task_id',
        'besichtigung_at',
        'result_interessent_id',
        'notes',
    ];

    protected $casts = [
        'besichtigung_at' => 'datetime',
        'created_at'      => 'datetime',
        'updated_at'      => 'datetime',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function teilnehmer()
    {
        return $this->belongsToMany(
            InterestedPerson::class,
            'besichtigung_teilnehmer',
            'besichtigung_id',
            'interested_person_id'
        )->withTimestamps();
    }

    public function ergebnis()
    {
        return $this->belongsTo(InterestedPerson::class, 'result_interessent_id');
    }
}
