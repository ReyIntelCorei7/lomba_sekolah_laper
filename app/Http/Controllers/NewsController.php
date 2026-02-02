<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::where('is_published', true)
                    ->orderBy('published_at', 'desc')
                    ->paginate(6);
        
        $popularNews = News::where('is_published', true)
                          ->orderBy('views', 'desc')
                          ->limit(5)
                          ->get();
        
        $featuredNews = News::where('is_published', true)
                           ->where('is_featured', true)
                           ->latest()
                           ->limit(3)
                           ->get();
        
        $categories = [
            'academic' => 'Akademik',
            'activity' => 'Kegiatan',
            'extracurricular' => 'Ekstrakurikuler',
            'arts' => 'Seni & Budaya',
            'alumni' => 'Alumni',
            'workshop' => 'Workshop',
            'achievement' => 'Prestasi',
            'scout' => 'Kepramukaan'
        ];
        
        return view('news.index', compact('news', 'popularNews', 'featuredNews', 'categories'));
    }
    
    public function show($slug)
    {
        $news = News::where('slug', $slug)
                    ->where('is_published', true)
                    ->firstOrFail();
        
        // Increment views
        $news->increment('views');
        
        $relatedNews = News::where('category', $news->category)
                          ->where('id', '!=', $news->id)
                          ->where('is_published', true)
                          ->limit(3)
                          ->get();
        
        return view('news.show', compact('news', 'relatedNews'));
    }
    
    public function category($category)
    {
        $news = News::where('category', $category)
                    ->where('is_published', true)
                    ->orderBy('published_at', 'desc')
                    ->paginate(6);
        
        $categories = [
            'academic' => 'Akademik',
            'activity' => 'Kegiatan',
            'extracurricular' => 'Ekstrakurikuler',
            'arts' => 'Seni & Budaya',
            'alumni' => 'Alumni',
            'workshop' => 'Workshop',
            'achievement' => 'Prestasi',
            'scout' => 'Kepramukaan'
        ];
        
        return view('news.category', [
            'news' => $news,
            'categoryName' => $categories[$category] ?? $category,
            'categorySlug' => $category,
            'categories' => $categories
        ]);
    }
}