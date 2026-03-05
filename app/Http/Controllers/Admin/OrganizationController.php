<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Traits\HandlesBase64Images;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrganizationController extends Controller
{
    use HandlesBase64Images;

    /**
     * Generate a unique slug for organization.
     */
    private function generateUniqueSlug(string $name, ?int $excludeId = null): string
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $counter = 2;

        while (Organization::where('slug', $slug)->when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

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

        // Generate unique slug
        $validated['slug'] = $this->generateUniqueSlug($validated['name']);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $validated['logo'] = $this->convertToBase64($request->file('logo'));
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $this->convertToBase64($request->file('image'));
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
            $validated['slug'] = $this->generateUniqueSlug($validated['name'], $organization->id);
        }

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $validated['logo'] = $this->convertToBase64($request->file('logo'));
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $this->convertToBase64($request->file('image'));
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
