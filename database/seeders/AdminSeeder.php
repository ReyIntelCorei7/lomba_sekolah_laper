<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Super Admin',
            'email' => 'admin@smkmetland.sch.id',
            'password' => Hash::make('admin123'),
            'role' => 'super_admin',
            'is_active' => true,
        ]);

        Admin::create([
            'name' => 'Admin PPDB',
            'email' => 'ppdb@smkmetland.sch.id',
            'password' => Hash::make('ppdb123'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        Admin::create([
            'name' => 'Staff TU',
            'email' => 'staff@smkmetland.sch.id',
            'password' => Hash::make('staff123'),
            'role' => 'staff',
            'is_active' => true,
        ]);
    }
}