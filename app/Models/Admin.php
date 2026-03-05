<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\HasRoles;
use App\Traits\Auditable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, Auditable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
        'last_login_at' => 'datetime',
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeSuperAdmin($query)
    {
        return $query->where('role', 'super_admin');
    }

    // Check if admin is super admin
    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
    }

    // Update last login
    public function updateLastLogin()
    {
        $this->update(['last_login_at' => now()]);
    }
}
