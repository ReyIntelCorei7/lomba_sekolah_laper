<?php

namespace App\Traits;

use App\Models\Role;

trait HasRoles
{
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'admin_role');
    }

    public function assignRole(string ...$roles): void
    {
        $roleModels = Role::whereIn('name', $roles)->get();
        $this->roles()->syncWithoutDetaching($roleModels->pluck('id'));
    }

    public function removeRole(string ...$roles): void
    {
        $roleModels = Role::whereIn('name', $roles)->get();
        $this->roles()->detach($roleModels->pluck('id'));
    }

    public function hasRole(string $role): bool
    {
        // Support legacy role column check
        if ($this->role === $role) {
            return true;
        }
        return $this->roles()->where('name', $role)->exists();
    }

    public function hasAnyRole(string ...$roles): bool
    {
        // Check legacy role column
        if (in_array($this->role, $roles)) {
            return true;
        }
        return $this->roles()->whereIn('name', $roles)->exists();
    }

    public function hasPermission(string $permission): bool
    {
        // Super admin has all permissions
        if ($this->role === 'super_admin' || $this->hasRole('super_admin')) {
            return true;
        }

        foreach ($this->roles as $role) {
            if ($role->hasPermission($permission)) {
                return true;
            }
        }
        return false;
    }

    public function hasAnyPermission(string ...$permissions): bool
    {
        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission)) {
                return true;
            }
        }
        return false;
    }

    public function getAllPermissions(): \Illuminate\Support\Collection
    {
        if ($this->role === 'super_admin' || $this->hasRole('super_admin')) {
            return \App\Models\Permission::all();
        }

        return $this->roles->flatMap(function ($role) {
            return $role->permissions;
        })->unique('id');
    }
}
