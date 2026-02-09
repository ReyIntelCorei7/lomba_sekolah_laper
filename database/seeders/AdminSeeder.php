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
        Admin::updateOrCreate(
            ['email' => 'admin@smkmetland.sch.id'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('admin123'),
                'role' => 'super_admin',
                'is_active' => true,
            ]
        );

        Admin::updateOrCreate(
            ['email' => 'ppdb@smkmetland.sch.id'],
            [
                'name' => 'Admin PPDB',
                'password' => Hash::make('ppdb123'),
                'role' => 'admin',
                'is_active' => true,
            ]
        );

        Admin::updateOrCreate(
            ['email' => 'staff@smkmetland.sch.id'],
            [
                'name' => 'Staff TU',
                'password' => Hash::make('staff123'),
                'role' => 'staff',
                'is_active' => true,
            ]
        );
    }
}
