<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;

    // 1. ADD THIS LINE (Change 'user_id' to your actual primary key column name if it is different)
    protected $primaryKey = 'user_id'; 

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password_hash',
        'role_id',
        'is_active',
        'email_verified_at',
        'email_verification_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    protected $hidden = [
        'password_hash',
        'remember_token',
    ];

    public function getAuthPasswordName()
    {
        return 'password_hash';
    }

    public function getAuthPassword(): string
    {
        return $this->password_hash;
    }

    public function getRememberToken() { return null; }
    public function setRememberToken($value) {}
    public function getRememberTokenName() { return ''; }

    public function hasVerifiedEmail(): bool
    {
        return $this->email_verified_at !== null;
    }

    public function markEmailAsVerified(): bool
    {
        return $this->update([
            'email_verified_at' => now(),
            'email_verification_token' => null,
        ]);
    }

    public static function generateVerificationToken(): string
    {
        return bin2hex(random_bytes(32));
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }
}