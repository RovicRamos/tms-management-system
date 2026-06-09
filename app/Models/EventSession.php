<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventSession extends Model
{
    protected $primaryKey = 'session_id';
    public $timestamps = false;

    protected $fillable = ['event_id', 'session_title', 'start_date', 'end_date', 'location'];

    // Ensures dates are cleanly cast to Carbon instances for formatting/manipulation
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }
}