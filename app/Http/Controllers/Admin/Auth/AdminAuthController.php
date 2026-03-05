<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

            $admin = Admin::where('email', $request->email)->first();

            if (!$admin || !Hash::check($request->password, $admin->password)) {
                // Log failed login attempt
                AuditLog::log(
                    action: 'login_failed',
                    description: 'Failed login attempt for email: ' . $request->email
                );

                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

            if (!$admin->is_active) {
                throw ValidationException::withMessages([
                    'email' => ['Your account has been deactivated.'],
                ]);
            }

            Auth::guard('admin')->login($admin, $request->boolean('remember'));
            $admin->updateLastLogin();

            $request->session()->regenerate();

            // Log successful login
            AuditLog::log(
                action: 'login',
                modelType: 'App\Models\Admin',
                modelId: $admin->id,
                description: 'Admin ' . $admin->name . ' berhasil login'
            );

            return redirect()->intended(route('admin.dashboard'));
            
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Login failed: ' . $e->getMessage()]);
        }
    }

    public function logout(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        // Log logout
        if ($admin) {
            AuditLog::log(
                action: 'logout',
                modelType: 'App\Models\Admin',
                modelId: $admin->id,
                description: 'Admin ' . $admin->name . ' logout'
            );
        }

        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}