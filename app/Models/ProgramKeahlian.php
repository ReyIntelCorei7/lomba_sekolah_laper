<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProgramKeahlian extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_name',
        'slug',
        'description',
        'short_description',
        'color_theme',
        'hero_image',
        'overview_image',
        'icon',
        'stat_competencies',
        'stat_employment',
        'stat_partners',
        'stat_label_1',
        'stat_label_2',
        'stat_label_3',
        'salary_range',
        'salary_label',
        'overview_content',
        'features',
        'is_active',
        'order',
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
        'stat_competencies' => 'integer',
        'stat_employment' => 'integer',
        'stat_partners' => 'integer',
        'order' => 'integer',
    ];

    /**
     * Get skills for this program
     */
    public function skills()
    {
        return $this->hasMany(ProgramSkill::class)->orderBy('order');
    }

    /**
     * Get careers for this program
     */
    public function careers()
    {
        return $this->hasMany(ProgramCareer::class)->orderBy('order');
    }

    /**
     * Scope for active programs
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordered programs
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    /**
     * Get hero image URL
     */
    public function getHeroImageUrlAttribute()
    {
        if ($this->hero_image) {
            return Storage::url($this->hero_image);
        }
        return asset('image/default-hero.jpg');
    }

    /**
     * Get overview image URL
     */
    public function getOverviewImageUrlAttribute()
    {
        if ($this->overview_image) {
            return Storage::url($this->overview_image);
        }
        return asset('image/default-overview.jpg');
    }

    /**
     * Get color classes based on theme
     */
    public function getColorClassesAttribute()
    {
        $colors = [
            'indigo' => [
                'primary' => 'indigo-600',
                'bg' => 'indigo-100',
                'text' => 'indigo-700',
                'gradient_from' => 'indigo-600',
                'gradient_to' => 'purple-600',
                'hero_from' => 'indigo-900',
                'hero_to' => 'slate-900',
            ],
            'purple' => [
                'primary' => 'purple-600',
                'bg' => 'purple-100',
                'text' => 'purple-700',
                'gradient_from' => 'purple-600',
                'gradient_to' => 'pink-600',
                'hero_from' => 'purple-900',
                'hero_to' => 'pink-900',
            ],
            'emerald' => [
                'primary' => 'emerald-600',
                'bg' => 'emerald-100',
                'text' => 'emerald-700',
                'gradient_from' => 'emerald-600',
                'gradient_to' => 'teal-600',
                'hero_from' => 'emerald-900',
                'hero_to' => 'teal-900',
            ],
            'orange' => [
                'primary' => 'orange-600',
                'bg' => 'orange-100',
                'text' => 'orange-700',
                'gradient_from' => 'orange-600',
                'gradient_to' => 'amber-600',
                'hero_from' => 'orange-900',
                'hero_to' => 'amber-900',
            ],
            'cyan' => [
                'primary' => 'cyan-600',
                'bg' => 'cyan-100',
                'text' => 'cyan-700',
                'gradient_from' => 'cyan-600',
                'gradient_to' => 'sky-600',
                'hero_from' => 'cyan-900',
                'hero_to' => 'sky-900',
            ],
        ];

        return $colors[$this->color_theme] ?? $colors['indigo'];
    }
}
