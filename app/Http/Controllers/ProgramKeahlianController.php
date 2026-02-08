<?php

namespace App\Http\Controllers;

use App\Models\ProgramKeahlian;
use Illuminate\Http\Request;

class ProgramKeahlianController extends Controller
{
    /**
     * Display a listing of all programs
     */
    public function index()
    {
        $programs = ProgramKeahlian::active()
            ->ordered()
            ->get();
        
        return view('program_keahlian.index', compact('programs'));
    }

    /**
     * Display the specified program
     */
    public function show($slug)
    {
        $program = ProgramKeahlian::where('slug', $slug)
            ->active()
            ->with(['skills', 'careers'])
            ->firstOrFail();
        
        return view('program_keahlian.show', compact('program'));
    }
}
