<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramKeahlian;
use App\Models\ProgramSkill;
use App\Models\ProgramCareer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProgramKeahlianController extends Controller
{
    /**
     * Display a listing of the programs
     */
    public function index()
    {
        $programs = ProgramKeahlian::ordered()
            ->withCount(['skills', 'careers'])
            ->paginate(10);
        
        return view('admin.program-keahlian.index', compact('programs'));
    }

    /**
     * Show the form for creating a new program
     */
    public function create()
    {
        $colorThemes = $this->getColorThemes();
        return view('admin.program-keahlian.create', compact('colorThemes'));
    }

    /**
     * Store a newly created program
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'short_name' => 'required|string|max:50',
            'slug' => 'required|string|max:255|unique:program_keahlians',
            'description' => 'required|string',
            'short_description' => 'required|string',
            'color_theme' => 'required|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'overview_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'icon' => 'nullable|string|max:100',
            'stat_competencies' => 'nullable|integer|min:0',
            'stat_employment' => 'nullable|integer|min:0|max:100',
            'stat_partners' => 'nullable|integer|min:0',
            'stat_label_1' => 'nullable|string|max:50',
            'stat_label_2' => 'nullable|string|max:50',
            'stat_label_3' => 'nullable|string|max:50',
            'salary_range' => 'nullable|string|max:100',
            'salary_label' => 'nullable|string|max:100',
            'overview_content' => 'nullable|string',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        // Handle hero image upload
        if ($request->hasFile('hero_image')) {
            $validated['hero_image'] = $request->file('hero_image')
                ->store('program-keahlian/hero', 'public');
        }

        // Handle overview image upload
        if ($request->hasFile('overview_image')) {
            $validated['overview_image'] = $request->file('overview_image')
                ->store('program-keahlian/overview', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        ProgramKeahlian::create($validated);

        return redirect()->route('admin.program-keahlian.index')
            ->with('success', 'Program Keahlian berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified program
     */
    public function edit(ProgramKeahlian $program_keahlian)
    {
        $program_keahlian->load(['skills', 'careers']);
        $colorThemes = $this->getColorThemes();
        $gradientColors = $this->getGradientColors();
        
        return view('admin.program-keahlian.edit', compact(
            'program_keahlian', 
            'colorThemes',
            'gradientColors'
        ));
    }

    /**
     * Update the specified program
     */
    public function update(Request $request, ProgramKeahlian $program_keahlian)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'short_name' => 'required|string|max:50',
            'slug' => 'required|string|max:255|unique:program_keahlians,slug,' . $program_keahlian->id,
            'description' => 'required|string',
            'short_description' => 'required|string',
            'color_theme' => 'required|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'overview_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'icon' => 'nullable|string|max:100',
            'stat_competencies' => 'nullable|integer|min:0',
            'stat_employment' => 'nullable|integer|min:0|max:100',
            'stat_partners' => 'nullable|integer|min:0',
            'stat_label_1' => 'nullable|string|max:50',
            'stat_label_2' => 'nullable|string|max:50',
            'stat_label_3' => 'nullable|string|max:50',
            'salary_range' => 'nullable|string|max:100',
            'salary_label' => 'nullable|string|max:100',
            'overview_content' => 'nullable|string',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        // Handle hero image upload
        if ($request->hasFile('hero_image')) {
            // Delete old image
            if ($program_keahlian->hero_image) {
                Storage::disk('public')->delete($program_keahlian->hero_image);
            }
            $validated['hero_image'] = $request->file('hero_image')
                ->store('program-keahlian/hero', 'public');
        }

        // Handle overview image upload
        if ($request->hasFile('overview_image')) {
            // Delete old image
            if ($program_keahlian->overview_image) {
                Storage::disk('public')->delete($program_keahlian->overview_image);
            }
            $validated['overview_image'] = $request->file('overview_image')
                ->store('program-keahlian/overview', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $program_keahlian->update($validated);

        return redirect()->route('admin.program-keahlian.edit', $program_keahlian)
            ->with('success', 'Program Keahlian berhasil diperbarui!');
    }

    /**
     * Remove the specified program
     */
    public function destroy(ProgramKeahlian $program_keahlian)
    {
        // Delete images
        if ($program_keahlian->hero_image) {
            Storage::disk('public')->delete($program_keahlian->hero_image);
        }
        if ($program_keahlian->overview_image) {
            Storage::disk('public')->delete($program_keahlian->overview_image);
        }

        $program_keahlian->delete();

        return redirect()->route('admin.program-keahlian.index')
            ->with('success', 'Program Keahlian berhasil dihapus!');
    }

    /**
     * Store a new skill for the program
     */
    public function storeSkill(Request $request, ProgramKeahlian $program_keahlian)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:100',
            'gradient_from' => 'required|string',
            'gradient_to' => 'required|string',
        ]);

        $validated['order'] = $program_keahlian->skills()->count();

        $program_keahlian->skills()->create($validated);

        return back()->with('success', 'Skill berhasil ditambahkan!');
    }

    /**
     * Update a skill
     */
    public function updateSkill(Request $request, ProgramSkill $skill)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:100',
            'gradient_from' => 'required|string',
            'gradient_to' => 'required|string',
        ]);

        $skill->update($validated);

        return back()->with('success', 'Skill berhasil diperbarui!');
    }

    /**
     * Delete a skill
     */
    public function destroySkill(ProgramSkill $skill)
    {
        $skill->delete();
        return back()->with('success', 'Skill berhasil dihapus!');
    }

    /**
     * Store a new career for the program
     */
    public function storeCareer(Request $request, ProgramKeahlian $program_keahlian)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:100',
            'gradient_from' => 'required|string',
            'gradient_to' => 'required|string',
        ]);

        $validated['order'] = $program_keahlian->careers()->count();

        $program_keahlian->careers()->create($validated);

        return back()->with('success', 'Karir berhasil ditambahkan!');
    }

    /**
     * Update a career
     */
    public function updateCareer(Request $request, ProgramCareer $career)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:100',
            'gradient_from' => 'required|string',
            'gradient_to' => 'required|string',
        ]);

        $career->update($validated);

        return back()->with('success', 'Karir berhasil diperbarui!');
    }

    /**
     * Delete a career
     */
    public function destroyCareer(ProgramCareer $career)
    {
        $career->delete();
        return back()->with('success', 'Karir berhasil dihapus!');
    }

    /**
     * Get available color themes
     */
    private function getColorThemes()
    {
        return [
            'indigo' => 'Indigo/Purple (Akuntansi)',
            'purple' => 'Purple/Pink (DKV)',
            'emerald' => 'Emerald/Teal (PPLG)',
            'orange' => 'Orange/Amber (Kuliner)',
            'cyan' => 'Cyan/Sky (Hotel)',
            'blue' => 'Blue',
            'red' => 'Red',
            'green' => 'Green',
            'pink' => 'Pink',
            'amber' => 'Amber',
        ];
    }

    /**
     * Get gradient color options
     */
    private function getGradientColors()
    {
        return [
            'blue-500', 'blue-600', 'blue-700',
            'indigo-500', 'indigo-600', 'indigo-700',
            'purple-500', 'purple-600', 'purple-700',
            'pink-500', 'pink-600', 'pink-700',
            'red-500', 'red-600', 'red-700',
            'orange-500', 'orange-600', 'orange-700',
            'amber-500', 'amber-600', 'amber-700',
            'yellow-500', 'yellow-600', 'yellow-700',
            'green-500', 'green-600', 'green-700',
            'emerald-500', 'emerald-600', 'emerald-700',
            'teal-500', 'teal-600', 'teal-700',
            'cyan-500', 'cyan-600', 'cyan-700',
            'sky-500', 'sky-600', 'sky-700',
            'violet-500', 'violet-600', 'violet-700',
            'rose-500', 'rose-600', 'rose-700',
            'slate-600', 'slate-700', 'slate-800',
        ];
    }
}
