<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    protected $primaryKey = 'user_id';
    public $timestamps = false; // We used a custom created_at timestamp instead

    protected $fillable = [
        'role_id', 
        'first_name', 
        'last_name', 
        'email', 
        'password_hash', 
        'phone', 
        'is_active'
    ];

    protected $hidden = ['password_hash']; // Keeps password secure when handling user arrays

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

    // For clients enrolling in events
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class, 'client_id', 'user_id');
    }
}