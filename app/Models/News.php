<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
 use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'category',
        'image',
        'author',
        'views',
        'is_published',
        'is_featured',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
        'is_featured' => 'boolean'
    ];

    // Auto generate slug from title
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($news) {
            $news->slug = Str::slug($news->title);
        });
        
        static::updating(function ($news) {
            $news->slug = Str::slug($news->title);
        });
    }

    // Scope for published news
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    // Scope for featured news
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Get formatted date
    public function getFormattedDateAttribute()
    {
        return $this->published_at?->format('d F Y') ?? $this->created_at->format('d F Y');
    }

    // Get reading time
    public function getReadingTimeAttribute()
    {
        $wordCount = str_word_count(strip_tags($this->content));
        $minutes = ceil($wordCount / 200);
        return $minutes . ' min read';
    }
}

