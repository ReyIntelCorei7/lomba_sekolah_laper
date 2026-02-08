<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Extracurricular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ExtracurricularController extends Controller
{
    /**
     * Display a listing of extracurriculars.
     */
    public function index(Request $request)
    {
        $query = Extracurricular::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('coach', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $extracurriculars = $query->ordered()->paginate(12);

        return view('admin.extracurriculars.index', compact('extracurriculars'));
    }

    /**
     * Show the form for creating a new extracurricular.
     */
    public function create()
    {
        return view('admin.extracurriculars.create');
    }

    /**
     * Store a newly created extracurricular.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'category' => 'required|in:olahraga,seni,akademik,teknologi,keagamaan,other',
            'schedule' => 'nullable|string|max:255',
            'coach' => 'nullable|string|max:255',
            'achievements' => 'nullable|string',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        // Generate slug
        $validated['slug'] = Str::slug($validated['name']);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('extracurriculars', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        Extracurricular::create($validated);

        return redirect()->route('admin.extracurriculars.index')
            ->with('success', 'Ekstrakurikuler berhasil ditambahkan!');
    }

    /**
     * Display the specified extracurricular.
     */
    public function show(Extracurricular $extracurricular)
    {
        return view('admin.extracurriculars.show', compact('extracurricular'));
    }

    /**
     * Show the form for editing the specified extracurricular.
     */
    public function edit(Extracurricular $extracurricular)
    {
        return view('admin.extracurriculars.edit', compact('extracurricular'));
    }

    /**
     * Update the specified extracurricular.
     */
    public function update(Request $request, Extracurricular $extracurricular)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'category' => 'required|in:olahraga,seni,akademik,teknologi,keagamaan,other',
            'schedule' => 'nullable|string|max:255',
            'coach' => 'nullable|string|max:255',
            'achievements' => 'nullable|string',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        // Generate new slug if name changed
        if ($extracurricular->name !== $validated['name']) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($extracurricular->image && Storage::disk('public')->exists($extracurricular->image)) {
                Storage::disk('public')->delete($extracurricular->image);
            }
            $validated['image'] = $request->file('image')->store('extracurriculars', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        $extracurricular->update($validated);

        return redirect()->route('admin.extracurriculars.index')
            ->with('success', 'Ekstrakurikuler berhasil diperbarui!');
    }

    /**
     * Remove the specified extracurricular.
     */
    public function destroy(Extracurricular $extracurricular)
    {
        // Delete image
        if ($extracurricular->image && Storage::disk('public')->exists($extracurricular->image)) {
            Storage::disk('public')->delete($extracurricular->image);
        }

        $extracurricular->delete();

        return redirect()->route('admin.extracurriculars.index')
            ->with('success', 'Ekstrakurikuler berhasil dihapus!');
    }

    /**
     * Toggle active status.
     */
    public function toggleActive(Extracurricular $extracurricular)
    {
        $extracurricular->update(['is_active' => !$extracurricular->is_active]);

        $status = $extracurricular->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->back()
            ->with('success', "Ekstrakurikuler berhasil {$status}!");
    }
}
