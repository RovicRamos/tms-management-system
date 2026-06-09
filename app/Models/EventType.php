<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EventType extends Model
{
    protected $primaryKey = 'type_id';
    public $timestamps = false;

    protected $fillable = ['type_name', 'required_role_id'];

    public function requiredRole(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'required_role_id', 'role_id');
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'type_id', 'type_id');
    }
}