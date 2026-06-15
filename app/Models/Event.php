<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $primaryKey = 'event_id';
    public $timestamps = false;

    protected $fillable = [
        'type_id', 
        'title', 
        'description', 
        'instructor_id', 
        'instructor_role_id', 
        'capacity', 
        'status'
    ];

    public function eventType(): BelongsTo
    {
        return $this->belongsTo(EventType::class, 'type_id', 'type_id');
    }

    public function instructor(): BelongsTo
    {
        // Removed the $this->instructor_role_id bug because relationship models 
        // can't reference instance properties ($this) cleanly inside eager loading loops
        return $this->belongsTo(User::class, 'instructor_id', 'user_id');
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(EventSession::class, 'event_id', 'event_id');
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class, 'event_id', 'event_id');
    }
}