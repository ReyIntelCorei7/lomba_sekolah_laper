<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

echo "==========================================================\n";
echo "       COMPLETE DATABASE SETUP FOR SMK METLAND            \n";
echo "==========================================================\n\n";

// ============================================================
// 1. ADMINS TABLE
// ============================================================
echo "1. Setting up ADMINS table...\n";
Schema::dropIfExists('admins');
Schema::create('admins', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->string('password');
    $table->string('role')->default('admin');
    $table->boolean('is_active')->default(true);
    $table->timestamp('last_login_at')->nullable();
    $table->rememberToken();
    $table->timestamps();
});

DB::table('admins')->insert([
    ['name' => 'Super Admin', 'email' => 'admin@smkmetland.sch.id', 'password' => bcrypt('admin123'), 'role' => 'superadmin', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
    ['name' => 'Admin PPDB', 'email' => 'ppdb@smkmetland.sch.id', 'password' => bcrypt('ppdb123'), 'role' => 'admin', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
    ['name' => 'Staff', 'email' => 'staff@smkmetland.sch.id', 'password' => bcrypt('staff123'), 'role' => 'staff', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
]);
echo "   ✓ admins: 3 accounts created\n";

// ============================================================
// 2. PROGRAMS TABLE
// ============================================================
echo "2. Setting up PROGRAMS table...\n";
Schema::dropIfExists('students'); // Drop students first due to FK
Schema::dropIfExists('programs');
Schema::create('programs', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('code')->unique();
    $table->text('description');
    $table->string('image')->nullable();
    $table->integer('capacity')->default(36);
    $table->integer('current_students')->default(0);
    $table->boolean('is_active')->default(true);
    $table->timestamps();
});

DB::table('programs')->insert([
    ['name' => 'Perhotelan', 'code' => 'PH', 'description' => 'Program keahlian yang mempersiapkan siswa untuk bekerja di industri perhotelan dengan standar internasional.', 'capacity' => 36, 'current_students' => 25, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
    ['name' => 'Kuliner', 'code' => 'KL', 'description' => 'Program keahlian kuliner yang melatih siswa menjadi chef profesional.', 'capacity' => 36, 'current_students' => 20, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
    ['name' => 'Manajemen Perkantoran', 'code' => 'MP', 'description' => 'Program keahlian yang mempersiapkan siswa untuk manajemen perkantoran modern.', 'capacity' => 36, 'current_students' => 18, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
]);
echo "   ✓ programs: 3 programs created\n";

// ============================================================
// 3. STUDENTS TABLE
// ============================================================
echo "3. Setting up STUDENTS table...\n";
Schema::create('students', function (Blueprint $table) {
    $table->id();
    $table->string('registration_number')->unique();
    $table->string('full_name');
    $table->string('email')->unique();
    $table->string('phone');
    $table->enum('gender', ['L', 'P']);
    $table->date('birth_date');
    $table->string('birth_place');
    $table->text('address');
    $table->string('parent_name');
    $table->string('parent_phone');
    $table->string('parent_job')->nullable();
    $table->string('school_origin');
    $table->decimal('average_grade', 5, 2)->nullable();
    $table->foreignId('program_id')->constrained()->onDelete('cascade');
    $table->enum('registration_type', ['online', 'offline'])->default('online');
    $table->enum('status', ['pending', 'accepted', 'rejected', 'waiting'])->default('pending');
    $table->string('photo')->nullable();
    $table->string('certificate')->nullable();
    $table->string('transcript')->nullable();
    $table->text('notes')->nullable();
    $table->timestamp('registered_at')->nullable();
    $table->timestamps();
});
echo "   ✓ students: table created (empty)\n";

// ============================================================
// 4. NEWS TABLE
// ============================================================
echo "4. Setting up NEWS table...\n";
Schema::dropIfExists('news');
Schema::create('news', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('slug')->unique();
    $table->text('excerpt')->nullable();
    $table->text('content');
    $table->string('category')->default('general');
    $table->string('image')->nullable();
    $table->string('author')->default('Admin');
    $table->integer('views')->default(0);
    $table->boolean('is_published')->default(true);
    $table->boolean('is_featured')->default(false);
    $table->timestamp('published_at')->nullable();
    $table->timestamps();
});

DB::table('news')->insert([
    ['title' => 'Selamat Datang di SMK Metland', 'slug' => 'selamat-datang-smk-metland', 'excerpt' => 'SMK Metland siap mencetak generasi unggul.', 'content' => 'SMK Pariwisata Metland adalah sekolah kejuruan yang berfokus pada pendidikan vokasional berkualitas tinggi. Dengan fasilitas modern dan kurikulum yang sesuai dengan kebutuhan industri, kami berkomitmen untuk mencetak lulusan yang siap kerja.', 'category' => 'general', 'author' => 'Admin', 'is_published' => true, 'is_featured' => true, 'published_at' => now(), 'created_at' => now(), 'updated_at' => now()],
    ['title' => 'Pendaftaran PPDB Dibuka', 'slug' => 'pendaftaran-ppdb-dibuka', 'excerpt' => 'PPDB tahun ajaran baru telah dibuka.', 'content' => 'Pendaftaran Peserta Didik Baru (PPDB) SMK Pariwisata Metland untuk tahun ajaran baru telah resmi dibuka. Segera daftarkan diri Anda untuk bergabung dengan keluarga besar SMK Metland.', 'category' => 'pengumuman', 'author' => 'Admin', 'is_published' => true, 'is_featured' => false, 'published_at' => now(), 'created_at' => now(), 'updated_at' => now()],
]);
echo "   ✓ news: 2 articles created\n";

// ============================================================
// 5. WEBSITE_SETTINGS TABLE
// ============================================================
echo "5. Setting up WEBSITE_SETTINGS table...\n";
Schema::dropIfExists('website_settings');
Schema::create('website_settings', function (Blueprint $table) {
    $table->id();
    $table->string('key')->unique();
    $table->text('value')->nullable();
    $table->string('type')->default('text');
    $table->string('group')->default('general');
    $table->string('label');
    $table->text('description')->nullable();
    $table->timestamps();
});

DB::table('website_settings')->insert([
    ['key' => 'hero_title', 'value' => 'Bridging the Gap Between Education & Industry', 'type' => 'text', 'group' => 'hero', 'label' => 'Hero Title', 'description' => 'Main title on hero section', 'created_at' => now(), 'updated_at' => now()],
    ['key' => 'hero_subtitle', 'value' => 'The High Standard in Vocational Education', 'type' => 'text', 'group' => 'hero', 'label' => 'Hero Subtitle', 'description' => 'Subtitle on hero section', 'created_at' => now(), 'updated_at' => now()],
    ['key' => 'school_name', 'value' => 'SMK Pariwisata Metland', 'type' => 'text', 'group' => 'general', 'label' => 'School Name', 'description' => 'Official school name', 'created_at' => now(), 'updated_at' => now()],
    ['key' => 'school_address', 'value' => 'Jl. Metland Transyogi, Bogor', 'type' => 'text', 'group' => 'contact', 'label' => 'School Address', 'description' => 'Official school address', 'created_at' => now(), 'updated_at' => now()],
    ['key' => 'school_phone', 'value' => '(021) 123-4567', 'type' => 'text', 'group' => 'contact', 'label' => 'School Phone', 'description' => 'Contact phone number', 'created_at' => now(), 'updated_at' => now()],
    ['key' => 'school_email', 'value' => 'info@smkmetland.sch.id', 'type' => 'text', 'group' => 'contact', 'label' => 'School Email', 'description' => 'Contact email', 'created_at' => now(), 'updated_at' => now()],
]);
echo "   ✓ website_settings: 6 settings created\n";

echo "\n==========================================================\n";
echo "       ALL TABLES CREATED SUCCESSFULLY!                   \n";
echo "==========================================================\n";
echo "\nLogin credentials:\n";
echo "  - Super Admin: admin@smkmetland.sch.id / admin123\n";
echo "  - Admin PPDB:  ppdb@smkmetland.sch.id / ppdb123\n";
echo "  - Staff:       staff@smkmetland.sch.id / staff123\n";
echo "\n";
