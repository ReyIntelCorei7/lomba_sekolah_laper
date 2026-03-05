<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Alumni extends Model
{
    use HasFactory;

    protected $table = 'alumni';

    /**
     * Columns to select when we want to exclude the large photo blob.
     */
    public const COLUMNS_WITHOUT_PHOTO = [
        'id', 'name', 'slug', 'graduation_year', 'program',
        'current_position', 'company_or_university', 'testimonial',
        'is_featured', 'is_active', 'order', 'created_at', 'updated_at',
    ];

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
                $baseSlug = Str::slug($alumni->name . '-' . $alumni->graduation_year);
                $slug = $baseSlug;
                $counter = 2;

                while (static::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }

                $alumni->slug = $slug;
            }
        });
    }

    /**
     * Override route model binding to NOT load the huge photo column.
     * Photos are served separately via ImageController.
     */
    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where($field ?? $this->getRouteKeyName(), $value)
            ->select(self::COLUMNS_WITHOUT_PHOTO)
            ->addSelect(DB::raw("(photo IS NOT NULL AND photo != '') as has_photo"))
            ->firstOrFail();
    }

    /**
     * Scope to select without photo column (for performance / Vercel payload).
     */
    public function scopeWithoutPhoto($query)
    {
        return $query->select(self::COLUMNS_WITHOUT_PHOTO)
            ->addSelect(DB::raw("(photo IS NOT NULL AND photo != '') as has_photo"));
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
     * Get photo URL - works with both full photo data and has_photo flag.
     * When photo column is excluded from query (for Vercel performance),
     * uses the has_photo flag to determine if a photo exists.
     */
    public function getPhotoUrlAttribute(): string
    {
        // Case 1: Photo data is fully loaded (e.g. direct DB access)
        $photoData = $this->attributes['photo'] ?? null;
        if ($photoData) {
            if (str_starts_with($photoData, 'data:')) {
                return route('image.show', ['table' => 'alumni', 'id' => $this->id, 'column' => 'photo']);
            }
            return asset('storage/' . $photoData);
        }

        // Case 2: Photo column was excluded, but has_photo flag is available
        $hasPhoto = $this->attributes['has_photo'] ?? null;
        if ($hasPhoto) {
            return route('image.show', ['table' => 'alumni', 'id' => $this->id, 'column' => 'photo']);
        }

        // Case 3: No photo - show default avatar with initials
        $initial = strtoupper(substr($this->name ?? 'A', 0, 1));
        return 'data:image/svg+xml,' . urlencode('<svg xmlns="http://www.w3.org/2000/svg" width="200" height="200"><rect fill="#4F46E5" width="200" height="200"/><text x="50%" y="50%" font-size="80" fill="white" text-anchor="middle" dy=".35em">' . $initial . '</text></svg>');
    }
}
