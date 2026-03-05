<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Program;
use App\Mail\PPDBVerificationMail;
use App\Services\FileUploadScanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            'gender' => 'required|in:L,P',
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

        // Scan uploaded files for security threats
        $scanner = new FileUploadScanner();

        if ($request->hasFile('photo')) {
            $result = $scanner->scan($request->file('photo'), 'image');
            if (!$result['safe']) {
                return back()->withErrors(['photo' => 'File foto tidak aman: ' . $result['reason']])->withInput();
            }
        }

        if ($request->hasFile('certificate')) {
            $result = $scanner->scan($request->file('certificate'), 'document');
            if (!$result['safe']) {
                return back()->withErrors(['certificate' => 'File ijazah tidak aman: ' . $result['reason']])->withInput();
            }
        }

        if ($request->hasFile('transcript')) {
            $result = $scanner->scan($request->file('transcript'), 'document');
            if (!$result['safe']) {
                return back()->withErrors(['transcript' => 'File transkrip tidak aman: ' . $result['reason']])->withInput();
            }
        }

        $data = $request->all();
        $data['registration_type'] = 'online';
        $data['status'] = 'pending';
        $data['registered_at'] = now();
        $data['email_verification_token'] = Str::random(64);

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

        // Send email verification
        try {
            Mail::to($student->email)->send(new PPDBVerificationMail($student));
        } catch (\Exception $e) {
            \Log::error('Failed to send PPDB verification email: ' . $e->getMessage());
        }

        return redirect()->route('ppdb.success', $student->registration_number)
            ->with('success', 'Pendaftaran berhasil! Silakan cek email Anda untuk verifikasi.');
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

    public function verifyEmail(Request $request)
    {
        $student = Student::where('email_verification_token', $request->token)->first();

        if (!$student) {
            return redirect()->route('ppdb.index')
                ->with('error', 'Token verifikasi tidak valid atau sudah digunakan.');
        }

        if ($student->email_verified_at) {
            return redirect()->route('ppdb.index')
                ->with('info', 'Email sudah terverifikasi sebelumnya.');
        }

        $student->update([
            'email_verified_at' => now(),
            'email_verification_token' => null,
        ]);

        return redirect()->route('ppdb.index')
            ->with('success', 'Email berhasil diverifikasi! Terima kasih.');
    }
}