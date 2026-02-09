<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function showNewsPage()
    {
        $featuredNews = News::where('is_published', true)
            ->where('is_featured', true)
            ->latest('published_at')
            ->first();

        // Load first 7 news items (+ 1 featured = 8 total)
        $news = News::where('is_published', true)
            ->where('is_featured', false)
            ->orderBy('published_at', 'desc')
            ->take(8)
            ->get();

        // Get total count for "load more" button visibility
        $totalNews = News::where('is_published', true)
            ->where('is_featured', false)
            ->count();

        $categories = [
            'all' => 'Semua',
            'academic' => 'Akademik',
            'activity' => 'Kegiatan',
            'achievement' => 'Prestasi',
            'workshop' => 'Workshop',
        ];

        // Get site settings for footer
        $settings = \App\Models\WebsiteSetting::all()->pluck('value', 'key');
        $logoUrl = isset($settings['site_logo']) && $settings['site_logo']
            ? asset('storage/' . $settings['site_logo'])
            : asset('image/logometland.png');

        return view('news.app', compact('featuredNews', 'news', 'categories', 'totalNews', 'settings', 'logoUrl'));
    }

    //load more news
    public function loadMoreNews(Request $request)
    {
        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', 9);
        $category = $request->input('category', 'all');

        $query = News::where('is_published', true)
            ->where('is_featured', false)
            ->orderBy('published_at', 'desc');

        // Filter by category if not 'all'
        if ($category !== 'all') {
            $query->where('category', $category);
        }

        $news = $query->skip($offset)->take($limit)->get();

        // Get total count for this category
        $totalQuery = News::where('is_published', true)
            ->where('is_featured', false);

        if ($category !== 'all') {
            $totalQuery->where('category', $category);
        }

        $total = $totalQuery->count();

        $newsData = $news->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'slug' => $item->slug,
                'category' => $item->category,
                'excerpt' => $item->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($item->content), 80),
                'image' => $item->image ? asset('storage/' . $item->image) : asset('image/sekolahsmkmetland.png'),
                'formatted_date' => $item->formatted_date,
                'views' => $item->views ?? 0,
                'url' => route('news.show', $item->slug),
            ];
        });

        return response()->json([
            'news' => $newsData,
            'hasMore' => ($offset + $limit) < $total,
            'total' => $total,
        ]);
    }

    // Public frontend
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

        // Category views
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


    public function adminIndex(Request $request)
    {
        $query = News::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'published') {
                $query->where('is_published', true);
            } else {
                $query->where('is_published', false);
            }
        }

        $news = $query->latest()->paginate(15);

        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }
    //Store News
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'author' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'published_at' => 'nullable|date',
            'is_published' => 'boolean',
            'is_featured' => 'boolean'
        ]);

        $data = $request->all();
        $data['author'] = $data['author'] ?? auth('admin')->user()->name;
        $data['is_published'] = $request->boolean('is_published');
        $data['is_featured'] = $request->boolean('is_featured');

        // One Featured at a time (News content)
        if ($data['is_featured']) {
            News::where('is_featured', true)->update(['is_featured' => false]);
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        if (!$data['published_at'] && $data['is_published']) {
            $data['published_at'] = now();
        }

        News::create($data);

        return redirect()->route('admin.news.index')
            ->with('success', 'News article created successfully.');
    }

    public function adminShow(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'author' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'published_at' => 'nullable|date',
            'is_published' => 'boolean',
            'is_featured' => 'boolean'
        ]);

        $data = $request->all();
        $data['is_published'] = $request->boolean('is_published');
        $data['is_featured'] = $request->boolean('is_featured');

        //Featured News
        if ($data['is_featured']) {
            News::where('is_featured', true)
                ->where('id', '!=', $news->id)
                ->update(['is_featured' => false]);
        }

        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::delete($news->image);
            }
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        if (!$data['published_at'] && $data['is_published'] && !$news->published_at) {
            $data['published_at'] = now();
        }

        $news->update($data);

        return redirect()->route('admin.news.index')
            ->with('success', 'News article updated successfully.');
    }

    public function destroy(News $news)
    {
        if ($news->image) {
            Storage::delete($news->image);
        }

        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'News article deleted successfully.');
    }

    public function togglePublish(News $news)
    {
        $news->update([
            'is_published' => !$news->is_published,
            'published_at' => !$news->is_published ? null : ($news->published_at ?? now())
        ]);

        $status = $news->is_published ? 'published' : 'unpublished';

        return back()->with('success', "Article {$status} successfully.");
    }
}
