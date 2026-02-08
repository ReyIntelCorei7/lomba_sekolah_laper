<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Extracurricular extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'category',
        'schedule',
        'coach',
        'achievements',
        'is_active',
        'order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Auto-generate slug from name
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('name') && empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    // Scope for active records only
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for ordering
    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('name');
    }

    // Get category label with icon
    public function getCategoryLabelAttribute()
    {
        $categories = [
            'olahraga' => '⚽ Olahraga',
            'seni' => '🎨 Seni & Budaya',
            'akademik' => '📚 Akademik',
            'teknologi' => '💻 Teknologi',
            'keagamaan' => '🕌 Keagamaan',
            'other' => '🎯 Lainnya',
        ];

        return $categories[$this->category] ?? $categories['other'];
    }

    // Get category color class
    public function getCategoryColorAttribute()
    {
        $colors = [
            'olahraga' => 'bg-green-500',
            'seni' => 'bg-pink-500',
            'akademik' => 'bg-blue-500',
            'teknologi' => 'bg-purple-500',
            'keagamaan' => 'bg-amber-500',
            'other' => 'bg-gray-500',
        ];

        return $colors[$this->category] ?? $colors['other'];
    }
}
