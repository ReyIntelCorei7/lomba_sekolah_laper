@extends('admin.layouts.app')

@section('title', 'Setup Two-Factor Authentication')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-slate-800/50 border border-slate-700 rounded-2xl p-8">
        <div class="text-center mb-8">
            <div class="mx-auto w-16 h-16 bg-blue-600/20 rounded-2xl flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-white">Setup Two-Factor Authentication</h2>
            <p class="text-slate-400 mt-2">Pindai QR code di bawah menggunakan Google Authenticator atau aplikasi 2FA lainnya</p>
        </div>

        @if($errors->any())
            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-xl text-red-400">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="flex flex-col items-center space-y-6">
            {{-- QR Code --}}
            <div class="bg-white p-4 rounded-xl">
                {!! $qrCodeSvg !!}
            </div>

            {{-- Manual Secret Key --}}
            <div class="w-full">
                <label class="block text-sm font-medium text-slate-400 mb-2">Atau masukkan kode ini secara manual:</label>
                <div class="bg-slate-900 border border-slate-600 rounded-lg px-4 py-3 font-mono text-lg text-center text-blue-400 tracking-widest select-all">
                    {{ $secret }}
                </div>
            </div>

            {{-- OTP Verification Form --}}
            <form method="POST" action="{{ route('admin.2fa.enable') }}" class="w-full space-y-4">
                @csrf
                <div>
                    <label for="otp" class="block text-sm font-medium text-slate-300 mb-2">Masukkan kode 6-digit dari aplikasi Anda:</label>
                    <input type="text" name="otp" id="otp" maxlength="6" pattern="[0-9]{6}" required
                           class="w-full bg-slate-900 border border-slate-600 rounded-lg px-4 py-3 text-white text-center text-2xl tracking-[0.5em] font-mono focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="000000" autocomplete="one-time-code">
                </div>
                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-xl transition-all shadow-lg shadow-blue-600/20">
                    Aktifkan 2FA
                </button>
            </form>

            <a href="{{ route('admin.dashboard') }}" class="text-slate-400 hover:text-white text-sm transition-colors">
                ← Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>
@endsection
