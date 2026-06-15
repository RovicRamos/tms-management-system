<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password_hash',
        'role_id',
    ];

    protected $hidden = [
        'password_hash',
    ];

    // Tell Laravel to use your custom column for authentication verification
    public function getAuthPasswordName()
    {
        return 'password_hash';
    }

    /**
     * Disable remember_token if your database table does not have it
     */
    public function getRememberToken() { return null; }
    public function setRememberToken($value) {}
    public function getRememberTokenName() { return ''; }
}