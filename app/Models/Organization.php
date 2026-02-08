<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'abbreviation',
        'description',
        'logo',
        'image',
        'category',
        'advisor',
        'vision',
        'mission',
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

    // Get category label
    public function getCategoryLabelAttribute()
    {
        $categories = [
            'osis' => '🏛️ OSIS',
            'mpk' => '⚖️ MPK',
            'pramuka' => '⚜️ Pramuka',
            'pmr' => '🏥 PMR',
            'paskibra' => '🎖️ Paskibra',
            'rohis' => '🕌 Rohis',
            'other' => '🎯 Lainnya',
        ];

        return $categories[$this->category] ?? $categories['other'];
    }

    // Get category color class
    public function getCategoryColorAttribute()
    {
        $colors = [
            'osis' => 'bg-blue-600',
            'mpk' => 'bg-purple-600',
            'pramuka' => 'bg-amber-600',
            'pmr' => 'bg-red-600',
            'paskibra' => 'bg-emerald-600',
            'rohis' => 'bg-teal-600',
            'other' => 'bg-gray-600',
        ];

        return $colors[$this->category] ?? $colors['other'];
    }
}
