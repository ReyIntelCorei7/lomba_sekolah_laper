<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AlumniController extends Controller
{
    /**
     * Display a listing of alumni.
     */
    public function index(Request $request)
    {
        $query = Alumni::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('current_position', 'like', "%{$search}%")
                  ->orWhere('company_or_university', 'like', "%{$search}%");
            });
        }

        // Filter by graduation year
        if ($request->filled('year')) {
            $query->where('graduation_year', $request->year);
        }

        // Filter by program
        if ($request->filled('program')) {
            $query->where('program', $request->program);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $alumni = $query->orderBy('graduation_year', 'desc')
                        ->orderBy('order')
                        ->paginate(12);

        // Get unique years for filter dropdown
        $years = Alumni::distinct()->pluck('graduation_year')->sortDesc();

        return view('admin.alumni.index', compact('alumni', 'years'));
    }

    /**
     * Show the form for creating a new alumni.
     */
    public function create()
    {
        return view('admin.alumni.create');
    }

    /**
     * Store a newly created alumni.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'graduation_year' => 'required|integer|min:2010|max:' . (date('Y') + 1),
            'program' => 'required|in:perhotelan,dkv,pplg,kuliner,akuntansi',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'current_position' => 'nullable|string|max:255',
            'company_or_university' => 'nullable|string|max:255',
            'testimonial' => 'nullable|string',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        // Generate slug
        $validated['slug'] = Str::slug($validated['name'] . '-' . $validated['graduation_year']);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('alumni', 'public');
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        Alumni::create($validated);

        return redirect()->route('admin.alumni.index')
            ->with('success', 'Alumni berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified alumni.
     */
    public function edit(Alumni $alumni)
    {
        return view('admin.alumni.edit', compact('alumni'));
    }

    /**
     * Update the specified alumni.
     */
    public function update(Request $request, Alumni $alumni)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'graduation_year' => 'required|integer|min:2010|max:' . (date('Y') + 1),
            'program' => 'required|in:perhotelan,dkv,pplg,kuliner,akuntansi',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'current_position' => 'nullable|string|max:255',
            'company_or_university' => 'nullable|string|max:255',
            'testimonial' => 'nullable|string',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        // Generate new slug if name or year changed
        if ($alumni->name !== $validated['name'] || $alumni->graduation_year !== $validated['graduation_year']) {
            $validated['slug'] = Str::slug($validated['name'] . '-' . $validated['graduation_year']);
        }

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($alumni->photo && Storage::disk('public')->exists($alumni->photo)) {
                Storage::disk('public')->delete($alumni->photo);
            }
            $validated['photo'] = $request->file('photo')->store('alumni', 'public');
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        $alumni->update($validated);

        return redirect()->route('admin.alumni.index')
            ->with('success', 'Alumni berhasil diperbarui!');
    }

    /**
     * Remove the specified alumni.
     */
    public function destroy(Alumni $alumni)
    {
        // Delete photo
        if ($alumni->photo && Storage::disk('public')->exists($alumni->photo)) {
            Storage::disk('public')->delete($alumni->photo);
        }

        $alumni->delete();

        return redirect()->route('admin.alumni.index')
            ->with('success', 'Alumni berhasil dihapus!');
    }

    /**
     * Toggle active status.
     */
    public function toggleActive(Alumni $alumni)
    {
        $alumni->update(['is_active' => !$alumni->is_active]);

        $status = $alumni->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->back()
            ->with('success', "Alumni berhasil {$status}!");
    }
}
