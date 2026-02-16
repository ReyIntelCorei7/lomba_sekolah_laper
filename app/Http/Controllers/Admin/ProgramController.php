<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Traits\HandlesBase64Images;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    use HandlesBase64Images;

    public function index()
    {
        $programs = Program::withCount('students')->paginate(10);
        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.programs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:programs,code',
            'description' => 'required|string',
            'capacity' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        
        $base64 = $this->processImageUpload($request, 'image');
        if ($base64) {
            $data['image'] = $base64;
        }

        Program::create($data);

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program created successfully.');
    }

    public function show(Program $program)
    {
        $program->load('students');
        return view('admin.programs.show', compact('program'));
    }

    public function edit(Program $program)
    {
        return view('admin.programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:programs,code,' . $program->id,
            'description' => 'required|string',
            'capacity' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        
        $base64 = $this->processImageUpload($request, 'image');
        if ($base64) {
            $data['image'] = $base64;
        }

        $program->update($data);

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program updated successfully.');
    }

    public function destroy(Program $program)
    {
        // Check if program has students
        if ($program->students()->count() > 0) {
            return back()->withErrors(['error' => 'Cannot delete program with registered students.']);
        }

        $program->delete();

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program deleted successfully.');
    }
}