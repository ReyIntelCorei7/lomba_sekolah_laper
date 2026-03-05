<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;

class AlumniPublicController extends Controller
{
    /**
     * Display the alumni page.
     */
    public function index(Request $request)
    {
        $query = Alumni::withoutPhoto()->active();

        // Filter by graduation year
        if ($request->filled('year')) {
            $query->where('graduation_year', $request->year);
        }

        // Filter by program
        if ($request->filled('program')) {
            $query->where('program', $request->program);
        }

        $alumni = $query->orderBy('is_featured', 'desc')
                        ->orderBy('graduation_year', 'desc')
                        ->orderBy('order')
                        ->paginate(12);

        // Get unique years for filter dropdown
        $years = Alumni::active()->distinct()->pluck('graduation_year')->sortDesc();

        // Get programs for filter
        $programs = [
            'perhotelan' => 'Perhotelan',
            'dkv' => 'Desain Komunikasi Visual',
            'pplg' => 'PPLG',
            'kuliner' => 'Tata Boga',
            'akuntansi' => 'Akuntansi',
        ];

        return view('alumni.index', compact('alumni', 'years', 'programs'));
    }
}
