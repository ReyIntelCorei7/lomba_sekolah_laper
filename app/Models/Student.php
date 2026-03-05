<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Auditable;

class Student extends Model
{
    use HasFactory, Auditable;

    protected $fillable = [
        'registration_number',
        'full_name',
        'email',
        'email_verified_at',
        'email_verification_token',
        'phone',
        'gender',
        'birth_date',
        'birth_place',
        'address',
        'parent_name',
        'parent_phone',
        'parent_job',
        'school_origin',
        'average_grade',
        'program_id',
        'registration_type',
        'status',
        'photo',
        'certificate',
        'transcript',
        'notes',
        'registered_at'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'registered_at' => 'datetime',
        'average_grade' => 'decimal:2',
        'email_verified_at' => 'datetime',
    ];

    // Relationships
    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeAccepted($query)
    {
        return $query->where('status', 'accepted');
    }

    public function scopeOnline($query)
    {
        return $query->where('registration_type', 'online');
    }

    public function scopeOffline($query)
    {
        return $query->where('registration_type', 'offline');
    }

    // Accessors
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'accepted' => 'bg-green-100 text-green-800',
            'rejected' => 'bg-red-100 text-red-800',
            'waiting' => 'bg-blue-100 text-blue-800'
        ];

        return $badges[$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    public function isEmailVerified(): bool
    {
        return $this->email_verified_at !== null;
    }

    // Generate registration number
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($student) {
            if (!$student->registration_number) {
                $year = date('Y');
                $lastNumber = static::whereYear('created_at', $year)->count() + 1;
                $student->registration_number = $year . str_pad($lastNumber, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}
