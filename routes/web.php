<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\PPDBController;
use App\Http\Controllers\EskulController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\AlumniPublicController;
use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Admin\AlumniController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use App\Http\Controllers\Admin\ExtracurricularController;
use App\Http\Controllers\Admin\OrganizationController;
use App\Http\Controllers\Admin\ProgramKeahlianController as AdminProgramKeahlianController;
use App\Http\Controllers\ProgramKeahlianController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;


// Serve uploaded files from /tmp/storage on Vercel (production)
if (config('app.env') === 'production') {
    Route::get('/storage/{path}', function ($path) {
        $fullPath = '/tmp/storage/' . $path;
        
        if (!file_exists($fullPath)) {
            abort(404);
        }
        
        $mimeType = mime_content_type($fullPath);
        return response()->file($fullPath, ['Content-Type' => $mimeType]);
    })->where('path', '.*');
}

// USER ROUTES

// Homepage 
Route::get('/', function () {
    try {
        $settings = \App\Models\WebsiteSetting::all()->pluck('value', 'key');
        $latestNews = \App\Models\News::where('is_published', true)
            ->latest('published_at')
            ->limit(3)
            ->get();
        $programs = \App\Models\Program::active()->get();
    } catch (\Exception $e) {
        $settings = collect();
        $latestNews = collect();
        $programs = collect();
    }

    return view('layouts.app', compact('settings', 'latestNews', 'programs'));
})->name('home');

// News 
Route::prefix('news')->name('news.')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('/load-more', [NewsController::class, 'loadMoreNews'])->name('load-more');
    Route::get('/kategori/{category}', [NewsController::class, 'category'])->name('category');
    Route::get('/{slug}', [NewsController::class, 'show'])->name('show');
});

// Static pages
Route::get('/news', [NewsController::class, 'showNewsPage'])->name('news.page');
Route::get('/about', fn() => view('aboutschool.index'))->name('about');
Route::get('/kurikulum', fn() => view('kurikulum.app'))->name('kurikulum');


// PROGRAM KEAHLIAN ROUTES


Route::prefix('prokeh')->name('prokeh.')->group(function () {
    Route::get('/', fn() => view('program_keahlian.index'))->name('index');
    Route::get('/akuntansi', fn() => view('program_keahlian.akuntansi'))->name('akuntansi');
    Route::get('/dkv', fn() => view('program_keahlian.dkv'))->name('dkv');
    Route::get('/hotel', fn() => view('program_keahlian.hotel'))->name('hotel');
    Route::get('/kuliner', fn() => view('program_keahlian.kuliner'))->name('kuliner');
    Route::get('/pplg', fn() => view('program_keahlian.pplg'))->name('pplg');
});


// AUTH ROUTES


Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');


//  ESKUL ROUTES


Route::prefix('eskul')->name('eskul.')->group(function () {
    Route::get('/', [EskulController::class, 'index'])->name('index');
    Route::get('/{slug}', [EskulController::class, 'show'])->name('show');
});


// ORGANISASI ROUTES


Route::prefix('organisasi')->name('organisasi.')->group(function () {
    Route::get('/', [OrganisasiController::class, 'index'])->name('index');
    Route::get('/{slug}', [OrganisasiController::class, 'show'])->name('show');
});

// ALUMNI ROUTES


Route::get('/alumni', [AlumniPublicController::class, 'index'])->name('alumni.index');


// PPDB ROUTES


Route::prefix('ppdb')->name('ppdb.')->group(function () {
    Route::get('/', [PPDBController::class, 'index'])->name('index');
    Route::get('/register', [PPDBController::class, 'create'])->name('create');
    Route::post('/register', [PPDBController::class, 'store'])->name('store');
    Route::get('/success/{registrationNumber}', [PPDBController::class, 'success'])->name('success');
    Route::get('/check', [PPDBController::class, 'check'])->name('check');
    Route::post('/status', [PPDBController::class, 'status'])->name('status');
});


// Smile route

Route::get('/smile', function () {
    return redirect('https://smile-metschoo.com');
});



// ADMIN ROUTES


Route::prefix('admin')->name('admin.')->group(function () {

    // Login
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');

    // Logout
    Route::middleware(['admin.auth'])->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Students 
        Route::resource('students', StudentController::class)->except(['create', 'store']);
        Route::patch('students/{student}/status', [StudentController::class, 'updateStatus'])
            ->name('students.update-status');
        Route::get('students/export', [StudentController::class, 'export'])
            ->name('students.export');

        // Programs 
        Route::resource('programs', ProgramController::class);

        // News 
        Route::get('news', [NewsController::class, 'adminIndex'])->name('news.index');
        Route::get('news/create', [NewsController::class, 'create'])->name('news.create');
        Route::post('news', [NewsController::class, 'store'])->name('news.store');
        Route::get('news/{news}', [NewsController::class, 'adminShow'])->name('news.show');
        Route::get('news/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
        Route::put('news/{news}', [NewsController::class, 'update'])->name('news.update');
        Route::delete('news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');
        Route::patch('news/{news}/toggle-publish', [NewsController::class, 'togglePublish'])
            ->name('news.toggle-publish');

        // Website Settings
        Route::get('settings', [WebsiteSettingController::class, 'index'])->name('settings.index');
        Route::post('settings', [WebsiteSettingController::class, 'update'])->name('settings.update');

        // Extracurriculars 
        Route::resource('extracurriculars', ExtracurricularController::class);
        Route::patch('extracurriculars/{extracurricular}/toggle-active', [ExtracurricularController::class, 'toggleActive'])
            ->name('extracurriculars.toggle-active');

        // Organizations 
        Route::resource('organizations', OrganizationController::class);
        Route::patch('organizations/{organization}/toggle-active', [OrganizationController::class, 'toggleActive'])
            ->name('organizations.toggle-active');

        // Alumni 
        Route::resource('alumni', AlumniController::class);
        Route::patch('alumni/{alumni}/toggle-active', [AlumniController::class, 'toggleActive'])
            ->name('alumni.toggle-active');

        // Program Keahlian 
        Route::resource('program-keahlian', AdminProgramKeahlianController::class);
        Route::post('program-keahlian/{program_keahlian}/skills', [AdminProgramKeahlianController::class, 'storeSkill'])
            ->name('program-keahlian.skills.store');
        Route::put('program-keahlian/skills/{skill}', [AdminProgramKeahlianController::class, 'updateSkill'])
            ->name('program-keahlian.skills.update');
        Route::delete('program-keahlian/skills/{skill}', [AdminProgramKeahlianController::class, 'destroySkill'])
            ->name('program-keahlian.skills.destroy');
        Route::post('program-keahlian/{program_keahlian}/careers', [AdminProgramKeahlianController::class, 'storeCareer'])
            ->name('program-keahlian.careers.store');
        Route::put('program-keahlian/careers/{career}', [AdminProgramKeahlianController::class, 'updateCareer'])
            ->name('program-keahlian.careers.update');
        Route::delete('program-keahlian/careers/{career}', [AdminProgramKeahlianController::class, 'destroyCareer'])
            ->name('program-keahlian.careers.destroy');
    });
});

// ============================================
// DEPLOYMENT HELPER ROUTES (HAPUS SETELAH SETUP!)
// ============================================

Route::get('/deploy/migrate/{secret}', function ($secret) {
    if ($secret !== 'metland2026-deploy-secret') {
        abort(404);
    }
    
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        $output = \Illuminate\Support\Facades\Artisan::output();
        return response()->json([
            'status' => 'success',
            'message' => 'Migration completed!',
            'output' => $output
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
});

Route::get('/deploy/seed/{secret}', function ($secret) {
    if ($secret !== 'metland2026-deploy-secret') {
        abort(404);
    }
    
    try {
        // Create/update default admin (no bcrypt - model 'hashed' cast handles it)
        $admin = \App\Models\Admin::updateOrCreate(
            ['email' => 'admin@metland.sch.id'],
            [
                'name' => 'Super Admin',
                'password' => 'admin123',
                'role' => 'super_admin',
                'is_active' => true,
            ]
        );
        
        // Create default website settings
        $settings = [
            ['key' => 'site_name', 'value' => 'SMK Metland', 'type' => 'text', 'group' => 'general', 'label' => 'Nama Website'],
            ['key' => 'site_description', 'value' => 'Website Resmi SMK Metland', 'type' => 'text', 'group' => 'general', 'label' => 'Deskripsi'],
            ['key' => 'site_logo', 'value' => '', 'type' => 'image', 'group' => 'general', 'label' => 'Logo'],
            ['key' => 'contact_email', 'value' => 'info@metland.sch.id', 'type' => 'text', 'group' => 'contact', 'label' => 'Email'],
            ['key' => 'contact_phone', 'value' => '', 'type' => 'text', 'group' => 'contact', 'label' => 'Telepon'],
            ['key' => 'contact_address', 'value' => '', 'type' => 'textarea', 'group' => 'contact', 'label' => 'Alamat'],
        ];
        
        foreach ($settings as $setting) {
            \App\Models\WebsiteSetting::firstOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
        
        return response()->json([
            'status' => 'success',
            'message' => 'Seeding completed!',
            'admin_email' => 'admin@metland.sch.id',
            'admin_password' => 'admin123 (GANTI SEGERA!)'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
});

Route::get('/deploy/status/{secret}', function ($secret) {
    if ($secret !== 'metland2026-deploy-secret') {
        abort(404);
    }
    
    try {
        $tables = \Illuminate\Support\Facades\DB::select('SHOW TABLES');
        return response()->json([
            'status' => 'success',
            'database_connected' => true,
            'tables' => $tables,
            'php_version' => PHP_VERSION,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'database_connected' => false,
            'message' => $e->getMessage()
        ], 500);
    }
});

Route::get('/deploy/reset-admin/{secret}', function ($secret) {
    if ($secret !== 'metland2026-deploy-secret') {
        abort(404);
    }
    
    try {
        // Force reset password using raw DB to bypass model 'hashed' cast
        $newPassword = bcrypt('admin123');
        
        $affected = \Illuminate\Support\Facades\DB::table('admins')
            ->where('email', 'admin@metland.sch.id')
            ->update(['password' => $newPassword]);
        
        if ($affected === 0) {
            // Admin doesn't exist, create directly via DB
            \Illuminate\Support\Facades\DB::table('admins')->insert([
                'name' => 'Super Admin',
                'email' => 'admin@metland.sch.id',
                'password' => $newPassword,
                'role' => 'super_admin',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $affected = 1;
        }
        
        return response()->json([
            'status' => 'success',
            'message' => "Admin password reset! Email: admin@metland.sch.id, Password: admin123",
            'rows_affected' => $affected
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
});

// ============================================
// END DEPLOYMENT HELPER ROUTES
// ============================================

// Not Found Page

Route::fallback(fn() => view('errors.404'));
