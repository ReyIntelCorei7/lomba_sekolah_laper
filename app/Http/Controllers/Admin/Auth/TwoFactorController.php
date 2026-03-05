<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Google2FA;

class TwoFactorController extends Controller
{
    protected Google2FA $google2fa;

    public function __construct()
    {
        $this->google2fa = new Google2FA();
    }

    /**
     * Show 2FA setup page with QR code
     */
    public function setup()
    {
        $admin = Auth::guard('admin')->user();

        if ($admin->google2fa_enabled) {
            return redirect()->route('admin.dashboard')
                ->with('info', '2FA sudah aktif pada akun Anda.');
        }

        $secret = $this->google2fa->generateSecretKey();
        session(['2fa_setup_secret' => $secret]);

        $qrCodeUrl = $this->google2fa->getQRCodeUrl(
            config('app.name', 'SMK Metland'),
            $admin->email,
            $secret
        );

        // Generate QR code as SVG using BaconQrCode
        $writer = new \BaconQrCode\Writer(
            new \BaconQrCode\Renderer\Image\SvgImageBackEnd()
        );
        $renderer = new \BaconQrCode\Renderer\ImageRenderer(
            new \BaconQrCode\Renderer\RendererStyle\RendererStyle(200),
            new \BaconQrCode\Renderer\Image\SvgImageBackEnd()
        );
        $writer = new \BaconQrCode\Writer($renderer);
        $qrCodeSvg = $writer->writeString($qrCodeUrl);

        return view('admin.auth.2fa-setup', compact('secret', 'qrCodeSvg'));
    }

    /**
     * Enable 2FA after verifying OTP
     */
    public function enable(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
        ]);

        $admin = Auth::guard('admin')->user();
        $secret = session('2fa_setup_secret');

        if (!$secret) {
            return redirect()->route('admin.2fa.setup')
                ->withErrors(['otp' => 'Sesi setup telah berakhir. Silakan ulangi.']);
        }

        $valid = $this->google2fa->verifyKey($secret, $request->otp);

        if (!$valid) {
            return back()->withErrors(['otp' => 'Kode OTP tidak valid. Silakan coba lagi.']);
        }

        $admin->update([
            'google2fa_secret' => encrypt($secret),
            'google2fa_enabled' => true,
        ]);

        session()->forget('2fa_setup_secret');
        session(['2fa_verified' => true]);

        AuditLog::log('2fa_enabled', 'App\Models\Admin', $admin->id, null, null, 'Admin mengaktifkan 2FA');

        return redirect()->route('admin.dashboard')
            ->with('success', 'Two-Factor Authentication berhasil diaktifkan!');
    }

    /**
     * Disable 2FA
     */
    public function disable(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        $admin = Auth::guard('admin')->user();

        if (!\Hash::check($request->password, $admin->password)) {
            return back()->withErrors(['password' => 'Password salah.']);
        }

        $admin->update([
            'google2fa_secret' => null,
            'google2fa_enabled' => false,
        ]);

        session()->forget('2fa_verified');

        AuditLog::log('2fa_disabled', 'App\Models\Admin', $admin->id, null, null, 'Admin menonaktifkan 2FA');

        return redirect()->route('admin.dashboard')
            ->with('success', 'Two-Factor Authentication berhasil dinonaktifkan.');
    }

    /**
     * Show 2FA challenge page (after login)
     */
    public function showChallenge()
    {
        $admin = Auth::guard('admin')->user();

        if (!$admin || !$admin->google2fa_enabled) {
            return redirect()->route('admin.dashboard');
        }

        if (session('2fa_verified')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.2fa-challenge');
    }

    /**
     * Verify 2FA OTP challenge
     */
    public function verifyChallenge(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
        ]);

        $admin = Auth::guard('admin')->user();

        if (!$admin || !$admin->google2fa_enabled) {
            return redirect()->route('admin.login');
        }

        try {
            $secret = decrypt($admin->google2fa_secret);
        } catch (\Exception $e) {
            return redirect()->route('admin.login')
                ->withErrors(['error' => 'Terjadi kesalahan pada konfigurasi 2FA.']);
        }

        $valid = $this->google2fa->verifyKey($secret, $request->otp);

        if (!$valid) {
            return back()->withErrors(['otp' => 'Kode OTP tidak valid. Silakan coba lagi.']);
        }

        session(['2fa_verified' => true]);

        AuditLog::log('2fa_verified', 'App\Models\Admin', $admin->id, null, null, 'Admin melewati verifikasi 2FA');

        return redirect()->intended(route('admin.dashboard'));
    }
}
