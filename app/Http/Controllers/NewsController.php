<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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

        return view('admin.news.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'author' => 'required|string|max:100',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
            'published_at' => 'nullable|date'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news-images', 'public');
            $validated['image'] = $imagePath;
        }

        // Generate slug
        $validated['slug'] = Str::slug($validated['title']);

        // Set published_at if not set
        if (empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        // Create news
        News::create($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
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

        return view('admin.news.edit', compact('news', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'author' => 'required|string|max:100',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
            'published_at' => 'nullable|date'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($news->image && Storage::disk('public')->exists($news->image)) {
                Storage::disk('public')->delete($news->image);
            }

            $imagePath = $request->file('image')->store('news-images', 'public');
            $validated['image'] = $imagePath;
        }

        // Generate slug
        $validated['slug'] = Str::slug($validated['title']);

        // Update news
        $news->update($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        // Delete image if exists
        if ($news->image && Storage::disk('public')->exists($news->image)) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return view('news.index')
            ->with('success', 'Berita berhasil dihapus!');
    }

    /**
     * Toggle publish status
     */
    public function togglePublish(News $news)
    {
        $news = News::latest()->get();
        return view('admin.news.index', compact('news'));
        $status = $news->is_published ? 'dipublikasikan' : 'disembunyikan';

        return back()->with('success', "Berita berhasil $status!");
    }
}
