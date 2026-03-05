<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TwoFactorAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        $admin = Auth::guard('admin')->user();

        if (!$admin) {
            return redirect()->route('admin.login');
        }

        // If 2FA is enabled but not yet verified in this session
        if ($admin->google2fa_enabled && !session('2fa_verified')) {
            return redirect()->route('admin.2fa.challenge');
        }

        return $next($request);
    }
}
