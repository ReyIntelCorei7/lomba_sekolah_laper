<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

echo "=== Fixing Admins Table with is_active ===\n";

// Drop and recreate admins table with correct structure including is_active
Schema::dropIfExists('admins');

Schema::create('admins', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->string('password');
    $table->string('role')->default('admin');
    $table->boolean('is_active')->default(true);  // Added this column!
    $table->timestamp('last_login_at')->nullable();
    $table->rememberToken();
    $table->timestamps();
});

echo "✓ Table 'admins' recreated with is_active column.\n";

// Insert demo accounts with is_active = true
DB::table('admins')->insert([
    [
        'name' => 'Super Admin',
        'email' => 'admin@smkmetland.sch.id',
        'password' => bcrypt('admin123'),
        'role' => 'superadmin',
        'is_active' => true,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Admin PPDB',
        'email' => 'ppdb@smkmetland.sch.id',
        'password' => bcrypt('ppdb123'),
        'role' => 'admin',
        'is_active' => true,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Staff',
        'email' => 'staff@smkmetland.sch.id',
        'password' => bcrypt('staff123'),
        'role' => 'staff',
        'is_active' => true,
        'created_at' => now(),
        'updated_at' => now(),
    ],
]);

echo "✓ 3 demo accounts created (all ACTIVE)!\n";
echo "\n=== Done! Try login now. ===\n";
