<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verifikasi 2FA - SMK Metland Admin</title>
    <link rel="icon" href="{{ asset('image/logometland.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full p-8">
        <div class="bg-slate-800/50 border border-slate-700 rounded-2xl p-8">
            <div class="text-center mb-8">
                <div class="mx-auto w-16 h-16 bg-amber-600/20 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-white">Verifikasi Two-Factor</h2>
                <p class="text-slate-400 mt-2">Masukkan kode 6-digit dari aplikasi Google Authenticator Anda</p>
            </div>

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-xl text-red-400">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.2fa.verify') }}" class="space-y-6">
                @csrf
                <div>
                    <input type="text" name="otp" id="otp" maxlength="6" pattern="[0-9]{6}" required autofocus
                           class="w-full bg-slate-900 border border-slate-600 rounded-lg px-4 py-4 text-white text-center text-3xl tracking-[0.5em] font-mono focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="000000" autocomplete="one-time-code">
                </div>
                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-xl transition-all shadow-lg shadow-blue-600/20">
                    Verifikasi
                </button>
            </form>

            <div class="mt-6 text-center">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="text-slate-400 hover:text-red-400 text-sm transition-colors">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Auto-focus and auto-submit on 6 digits
        document.getElementById('otp').addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (this.value.length === 6) {
                this.closest('form').submit();
            }
        });
    </script>
</body>
</html>
