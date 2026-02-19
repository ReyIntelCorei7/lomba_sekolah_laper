<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with('program');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by program
        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }

        // Filter by registration type
        if ($request->filled('registration_type')) {
            $query->where('registration_type', $request->registration_type);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('registration_number', 'like', "%{$search}%");
            });
        }

        $students = $query->latest()->paginate(15);
        $programs = Program::active()->get();

        return view('admin.students.index', compact('students', 'programs'));
    }

    public function show(Student $student)
    {
        $student->load('program');
        return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $programs = Program::active()->get();
        return view('admin.students.edit', compact('student', 'programs'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:L,P',
            'birth_date' => 'required|date',
            'birth_place' => 'required|string|max:255',
            'address' => 'required|string',
            'parent_name' => 'required|string|max:255',
            'parent_phone' => 'required|string|max:20',
            'parent_job' => 'required|string|max:255',
            'school_origin' => 'required|string|max:255',
            'average_grade' => 'nullable|numeric|min:0|max:100',
            'program_id' => 'required|exists:programs,id',
            'status' => 'required|in:pending,accepted,rejected,waiting',
            'notes' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'certificate' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:5120',
            'transcript' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:5120',
        ]);

        $data = $request->except(['photo', 'certificate', 'transcript']);

        // Handle file uploads
        if ($request->hasFile('photo')) {
            // Delete old file
            if ($student->photo) {
                Storage::disk('public')->delete($student->photo);
            }
            $data['photo'] = $request->file('photo')->store('students/photos', 'public');
        }

        if ($request->hasFile('certificate')) {
            if ($student->certificate) {
                Storage::disk('public')->delete($student->certificate);
            }
            $data['certificate'] = $request->file('certificate')->store('students/certificates', 'public');
        }

        if ($request->hasFile('transcript')) {
            if ($student->transcript) {
                Storage::disk('public')->delete($student->transcript);
            }
            $data['transcript'] = $request->file('transcript')->store('students/transcripts', 'public');
        }

        $student->update($data);

        return redirect()->route('admin.students.show', $student)
            ->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        // Delete associated files
        if ($student->photo) {
            Storage::delete($student->photo);
        }
        if ($student->certificate) {
            Storage::delete($student->certificate);
        }
        if ($student->transcript) {
            Storage::delete($student->transcript);
        }

        $student->delete();

        return redirect()->route('admin.students.index')
            ->with('success', 'Student deleted successfully.');
    }

    public function updateStatus(Request $request, Student $student)
    {
        $request->validate([
            'status' => 'required|in:pending,accepted,rejected,waiting',
            'notes' => 'nullable|string'
        ]);

        $student->update([
            'status' => $request->status,
            'notes' => $request->notes
        ]);

        return back()->with('success', 'Student status updated successfully.');
    }

    public function export(Request $request)
    {
        $query = Student::with('program');

        // Apply same filters as index
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }
        if ($request->filled('registration_type')) {
            $query->where('registration_type', $request->registration_type);
        }

        $students = $query->get();

        $filename = 'students_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($students) {
            $file = fopen('php://output', 'w');
            
            // CSV headers
            fputcsv($file, [
                'Registration Number', 'Full Name', 'Email', 'Phone', 'Gender',
                'Birth Date', 'Birth Place', 'Address', 'Parent Name', 'Parent Phone',
                'Parent Job', 'School Origin', 'Average Grade', 'Program', 'Status',
                'Registration Type', 'Registered At'
            ]);

            // CSV data
            foreach ($students as $student) {
                fputcsv($file, [
                    $student->registration_number,
                    $student->full_name,
                    $student->email,
                    $student->phone,
                    $student->gender,
                    $student->birth_date->format('Y-m-d'),
                    $student->birth_place,
                    $student->address,
                    $student->parent_name,
                    $student->parent_phone,
                    $student->parent_job,
                    $student->school_origin,
                    $student->average_grade,
                    $student->program->name,
                    $student->status,
                    $student->registration_type,
                    $student->registered_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}