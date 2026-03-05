<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        $admin = Auth::guard('admin')->user();

        if (!$admin) {
            return redirect()->route('admin.login');
        }

        // Super admin bypasses all permission checks
        if ($admin->role === 'super_admin') {
            return $next($request);
        }

        if (!$admin->hasPermission($permission)) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}
