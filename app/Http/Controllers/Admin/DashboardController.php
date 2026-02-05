<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Program;
use App\Models\News;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_students' => Student::count(),
            'pending_applications' => Student::pending()->count(),
            'accepted_students' => Student::accepted()->count(),
            'online_registrations' => Student::online()->count(),
            'offline_registrations' => Student::offline()->count(),
            'total_programs' => Program::active()->count(),
            'total_news' => News::count(),
            'published_news' => News::published()->count(),
        ];

        $recent_students = Student::with('program')
            ->latest()
            ->limit(5)
            ->get();

        $program_stats = Program::withCount('students')
            ->get()
            ->map(function ($program) {
                return [
                    'name' => $program->name,
                    'students_count' => $program->students_count,
                    'capacity' => $program->capacity,
                    'occupancy_percentage' => $program->occupancy_percentage
                ];
            });

        $monthly_registrations = Student::selectRaw("strftime('%m', created_at) as month, COUNT(*) as count")
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('count', 'month');

        return view('admin.dashboard', compact(
            'stats', 
            'recent_students', 
            'program_stats', 
            'monthly_registrations'
        ));
    }
}