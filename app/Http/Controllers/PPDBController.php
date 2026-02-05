<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PPDBController extends Controller
{
    public function index()
    {
        $programs = Program::active()->get();
        return view('ppdb.index', compact('programs'));
    }

    public function create()
    {
        $programs = Program::active()->get();
        return view('ppdb.create', compact('programs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:male,female',
            'birth_date' => 'required|date|before:today',
            'birth_place' => 'required|string|max:255',
            'address' => 'required|string',
            'parent_name' => 'required|string|max:255',
            'parent_phone' => 'required|string|max:20',
            'parent_job' => 'required|string|max:255',
            'school_origin' => 'required|string|max:255',
            'average_grade' => 'nullable|numeric|min:0|max:100',
            'program_id' => 'required|exists:programs,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'certificate' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:5120',
            'transcript' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:5120',
        ]);

        $data = $request->all();
        $data['registration_type'] = 'online';
        $data['status'] = 'pending';
        $data['registered_at'] = now();

        // Handle file uploads
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('students/photos', 'public');
        }

        if ($request->hasFile('certificate')) {
            $data['certificate'] = $request->file('certificate')->store('students/certificates', 'public');
        }

        if ($request->hasFile('transcript')) {
            $data['transcript'] = $request->file('transcript')->store('students/transcripts', 'public');
        }

        $student = Student::create($data);

        return redirect()->route('ppdb.success', $student->registration_number)
            ->with('success', 'Registration submitted successfully!');
    }

    public function success($registrationNumber)
    {
        $student = Student::where('registration_number', $registrationNumber)->firstOrFail();
        return view('ppdb.success', compact('student'));
    }

    public function check()
    {
        return view('ppdb.check');
    }

    public function status(Request $request)
    {
        $request->validate([
            'registration_number' => 'required|string',
            'email' => 'required|email'
        ]);

        $student = Student::where('registration_number', $request->registration_number)
            ->where('email', $request->email)
            ->first();

        if (!$student) {
            return back()->withErrors(['registration_number' => 'Registration not found.']);
        }

        return view('ppdb.status', compact('student'));
    }
}