<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'image',
        'capacity',
        'current_students',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    // Relationships
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Accessors
    public function getAvailableSlotsAttribute()
    {
        return $this->capacity - $this->current_students;
    }

    public function getIsFullAttribute()
    {
        return $this->current_students >= $this->capacity;
    }

    public function getOccupancyPercentageAttribute()
    {
        return $this->capacity > 0 ? round(($this->current_students / $this->capacity) * 100, 1) : 0;
    }
}
