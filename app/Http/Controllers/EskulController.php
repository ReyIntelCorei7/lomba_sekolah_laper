<?php

namespace App\Http\Controllers;

use App\Models\Extracurricular;
use Illuminate\Http\Request;

class EskulController extends Controller
{
    /**
     * Display listing of all active extracurriculars.
     */
    public function index(Request $request)
    {
        $query = Extracurricular::active()->ordered();

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $extracurriculars = $query->get();
        
        // Get all categories for filter
        $categories = [
            'olahraga' => '⚽ Olahraga',
            'seni' => '🎨 Seni & Budaya',
            'akademik' => '📚 Akademik',
            'teknologi' => '💻 Teknologi',
            'keagamaan' => '🕌 Keagamaan',
            'other' => '🎯 Lainnya',
        ];

        return view('eskul.index', compact('extracurriculars', 'categories'));
    }

    /**
     * Display the specified extracurricular.
     */
    public function show($slug)
    {
        $extracurricular = Extracurricular::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Get related extracurriculars in same category
        $related = Extracurricular::active()
            ->where('category', $extracurricular->category)
            ->where('id', '!=', $extracurricular->id)
            ->limit(3)
            ->get();

        return view('eskul.show', compact('extracurricular', 'related'));
    }
}
