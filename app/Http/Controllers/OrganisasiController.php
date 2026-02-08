<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

class OrganisasiController extends Controller
{
    /**
     * Display listing of all active organizations.
     */
    public function index(Request $request)
    {
        $query = Organization::active()->ordered();

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $organizations = $query->get();
        
        // Get all categories for filter
        $categories = [
            'osis' => '🏛️ OSIS',
            'mpk' => '⚖️ MPK',
            'pramuka' => '⚜️ Pramuka',
            'pmr' => '🏥 PMR',
            'paskibra' => '🎖️ Paskibra',
            'rohis' => '🕌 Rohis',
            'other' => '🎯 Lainnya',
        ];

        return view('organisasi.index', compact('organizations', 'categories'));
    }

    /**
     * Display the specified organization.
     */
    public function show($slug)
    {
        $organization = Organization::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Get other organizations
        $related = Organization::active()
            ->where('id', '!=', $organization->id)
            ->limit(3)
            ->get();

        return view('organisasi.show', compact('organization', 'related'));
    }
}
