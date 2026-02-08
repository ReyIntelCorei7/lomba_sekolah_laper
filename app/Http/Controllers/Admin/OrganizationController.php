<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OrganizationController extends Controller
{
    /**
     * Display a listing of organizations.
     */
    public function index(Request $request)
    {
        $query = Organization::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('abbreviation', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
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

        $organizations = $query->ordered()->paginate(12);

        return view('admin.organizations.index', compact('organizations'));
    }

    /**
     * Show the form for creating a new organization.
     */
    public function create()
    {
        return view('admin.organizations.create');
    }

    /**
     * Store a newly created organization.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'abbreviation' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:1024',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'category' => 'required|in:osis,mpk,pramuka,pmr,paskibra,rohis,other',
            'advisor' => 'nullable|string|max:255',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'achievements' => 'nullable|string',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        // Generate slug
        $validated['slug'] = Str::slug($validated['name']);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('organizations/logos', 'public');
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('organizations/images', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        Organization::create($validated);

        return redirect()->route('admin.organizations.index')
            ->with('success', 'Organisasi berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified organization.
     */
    public function edit(Organization $organization)
    {
        return view('admin.organizations.edit', compact('organization'));
    }

    /**
     * Update the specified organization.
     */
    public function update(Request $request, Organization $organization)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'abbreviation' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:1024',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'category' => 'required|in:osis,mpk,pramuka,pmr,paskibra,rohis,other',
            'advisor' => 'nullable|string|max:255',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'achievements' => 'nullable|string',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        // Generate new slug if name changed
        if ($organization->name !== $validated['name']) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Handle logo upload
        if ($request->hasFile('logo')) {
            if ($organization->logo && Storage::disk('public')->exists($organization->logo)) {
                Storage::disk('public')->delete($organization->logo);
            }
            $validated['logo'] = $request->file('logo')->store('organizations/logos', 'public');
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($organization->image && Storage::disk('public')->exists($organization->image)) {
                Storage::disk('public')->delete($organization->image);
            }
            $validated['image'] = $request->file('image')->store('organizations/images', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        $organization->update($validated);

        return redirect()->route('admin.organizations.index')
            ->with('success', 'Organisasi berhasil diperbarui!');
    }

    /**
     * Remove the specified organization.
     */
    public function destroy(Organization $organization)
    {
        // Delete logo
        if ($organization->logo && Storage::disk('public')->exists($organization->logo)) {
            Storage::disk('public')->delete($organization->logo);
        }

        // Delete image
        if ($organization->image && Storage::disk('public')->exists($organization->image)) {
            Storage::disk('public')->delete($organization->image);
        }

        $organization->delete();

        return redirect()->route('admin.organizations.index')
            ->with('success', 'Organisasi berhasil dihapus!');
    }

    /**
     * Toggle active status.
     */
    public function toggleActive(Organization $organization)
    {
        $organization->update(['is_active' => !$organization->is_active]);

        $status = $organization->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->back()
            ->with('success', "Organisasi berhasil {$status}!");
    }
}
