<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\Admin;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Create permissions
        $permissions = [
            ['name' => 'manage-students', 'display_name' => 'Kelola Siswa', 'group' => 'students'],
            ['name' => 'manage-news', 'display_name' => 'Kelola Berita', 'group' => 'news'],
            ['name' => 'manage-settings', 'display_name' => 'Kelola Pengaturan', 'group' => 'settings'],
            ['name' => 'manage-extracurriculars', 'display_name' => 'Kelola Eskul', 'group' => 'extracurriculars'],
            ['name' => 'manage-organizations', 'display_name' => 'Kelola Organisasi', 'group' => 'organizations'],
            ['name' => 'manage-alumni', 'display_name' => 'Kelola Alumni', 'group' => 'alumni'],
            ['name' => 'view-audit-logs', 'display_name' => 'Lihat Audit Logs', 'group' => 'audit'],
            ['name' => 'manage-admins', 'display_name' => 'Kelola Admin', 'group' => 'admins'],
        ];

        foreach ($permissions as $perm) {
            Permission::updateOrCreate(['name' => $perm['name']], $perm);
        }

        // Create roles with permissions
        $superAdmin = Role::updateOrCreate(
            ['name' => 'super_admin'],
            ['display_name' => 'Super Admin']
        );
        $superAdmin->givePermission(...array_column($permissions, 'name'));

        $admin = Role::updateOrCreate(
            ['name' => 'admin'],
            ['display_name' => 'Admin']
        );
        $admin->givePermission(
            'manage-students', 'manage-news', 'manage-extracurriculars',
            'manage-organizations', 'manage-alumni'
        );

        $editor = Role::updateOrCreate(
            ['name' => 'editor'],
            ['display_name' => 'Editor']
        );
        $editor->givePermission('manage-news');

        $viewer = Role::updateOrCreate(
            ['name' => 'viewer'],
            ['display_name' => 'Viewer']
        );
        // Viewer has no special permissions

        // Assign super_admin role to existing super_admin admins
        $superAdmins = Admin::where('role', 'super_admin')->get();
        foreach ($superAdmins as $sa) {
            $sa->assignRole('super_admin');
        }
    }
}
