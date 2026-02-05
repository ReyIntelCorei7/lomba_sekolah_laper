<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

echo "=== Creating Missing Tables ===\n";

// 1. Create programs table
if (!Schema::hasTable('programs')) {
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
    
    // Insert sample programs
    DB::table('programs')->insert([
        [
            'name' => 'Perhotelan',
            'code' => 'PH',
            'description' => 'Program keahlian yang mempersiapkan siswa untuk bekerja di industri perhotelan dengan standar internasional.',
            'image' => null,
            'capacity' => 36,
            'current_students' => 0,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'Kuliner',
            'code' => 'KL',
            'description' => 'Program keahlian kuliner yang melatih siswa menjadi chef profesional.',
            'image' => null,
            'capacity' => 36,
            'current_students' => 0,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'Manajemen Perkantoran',
            'code' => 'MP',
            'description' => 'Program keahlian yang mempersiapkan siswa untuk manajemen perkantoran modern.',
            'image' => null,
            'capacity' => 36,
            'current_students' => 0,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ]);
    echo "✓ Table 'programs' created with sample data.\n";
} else {
    echo "! Table 'programs' already exists.\n";
}

// 2. Create news table
if (!Schema::hasTable('news')) {
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
    
    // Insert sample news
    DB::table('news')->insert([
        [
            'title' => 'Selamat Datang di SMK Metland',
            'slug' => 'selamat-datang-di-smk-metland',
            'excerpt' => 'Sekolah vokasional berkualitas dengan fasilitas modern.',
            'content' => 'SMK Metland adalah sekolah kejuruan yang berfokus pada pendidikan vokasional berkualitas tinggi.',
            'category' => 'general',
            'image' => null,
            'author' => 'Admin',
            'views' => 0,
            'is_published' => true,
            'is_featured' => true,
            'published_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ]);
    echo "✓ Table 'news' created with sample data.\n";
} else {
    echo "! Table 'news' already exists.\n";
}

// 3. Create students table  
if (!Schema::hasTable('students')) {
    Schema::create('students', function (Blueprint $table) {
        $table->id();
        $table->string('registration_number')->unique();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('phone');
        $table->string('gender');
        $table->string('birth_place');
        $table->date('birth_date');
        $table->text('address');
        $table->string('previous_school');
        $table->string('program_code');
        $table->string('parent_name');
        $table->string('parent_phone');
        $table->string('parent_job')->nullable();
        $table->string('status')->default('pending');
        $table->timestamps();
    });
    echo "✓ Table 'students' created.\n";
} else {
    echo "! Table 'students' already exists.\n";
}

// 4. Create admins table
if (!Schema::hasTable('admins')) {
    Schema::create('admins', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('password');
        $table->string('role')->default('admin');
        $table->rememberToken();
        $table->timestamps();
    });
    
    // Insert default admin
    DB::table('admins')->insert([
        'name' => 'Administrator',
        'email' => 'admin@metland.sch.id',
        'password' => bcrypt('password'),
        'role' => 'superadmin',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    echo "✓ Table 'admins' created with default admin.\n";
} else {
    echo "! Table 'admins' already exists.\n";
}

echo "\n=== All tables processed! ===\n";
