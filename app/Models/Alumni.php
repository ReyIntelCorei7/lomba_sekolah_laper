<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Alumni extends Model
{
    use HasFactory;

    protected $table = 'alumni';

    protected $fillable = [
        'name',
        'slug',
        'graduation_year',
        'program',
        'photo',
        'current_position',
        'company_or_university',
        'testimonial',
        'is_featured',
        'is_active',
        'order',
    ];

    protected $casts = [
        'graduation_year' => 'integer',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($alumni) {
            if (empty($alumni->slug)) {
                $alumni->slug = Str::slug($alumni->name . '-' . $alumni->graduation_year);
            }
        });
    }

    /**
     * Scope for active alumni
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for featured alumni
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Get program label with color
     */
    public function getProgramLabelAttribute(): string
    {
        $labels = [
            'perhotelan' => 'Perhotelan',
            'dkv' => 'Desain Komunikasi Visual',
            'pplg' => 'PPLG',
            'kuliner' => 'Tata Boga',
            'akuntansi' => 'Akuntansi',
        ];

        return $labels[strtolower($this->program)] ?? $this->program;
    }

    /**
     * Get program color class
     */
    public function getProgramColorAttribute(): string
    {
        $colors = [
            'perhotelan' => 'bg-blue-600',
            'dkv' => 'bg-purple-600',
            'pplg' => 'bg-green-600',
            'kuliner' => 'bg-orange-600',
            'akuntansi' => 'bg-indigo-600',
        ];

        return $colors[strtolower($this->program)] ?? 'bg-gray-600';
    }

    /**
     * Get photo URL
     */
    public function getPhotoUrlAttribute(): string
    {
        if ($this->photo) {
            // If stored as base64, use the image serving route
            if (str_starts_with($this->photo, 'data:')) {
                return route('image.show', ['table' => 'alumni', 'id' => $this->id, 'column' => 'photo']);
            }
            // Otherwise it's a file path
            return asset('storage/' . $this->photo);
        }
        
        // Default avatar with initials
        return 'data:image/svg+xml,' . urlencode('<svg xmlns="http://www.w3.org/2000/svg" width="200" height="200"><rect fill="#4F46E5" width="200" height="200"/><text x="50%" y="50%" font-size="80" fill="white" text-anchor="middle" dy=".35em">' . strtoupper(substr($this->name, 0, 1)) . '</text></svg>');
    }
}
