<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email PPDB</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f3f4f6; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .header { background: linear-gradient(135deg, #2563eb, #1d4ed8); padding: 30px; text-align: center; }
        .header h1 { color: white; margin: 0; font-size: 24px; }
        .header p { color: rgba(255,255,255,0.8); margin: 8px 0 0; }
        .content { padding: 30px; }
        .content p { color: #4b5563; line-height: 1.6; }
        .info-box { background: #f0f9ff; border: 1px solid #bae6fd; border-radius: 8px; padding: 16px; margin: 20px 0; }
        .info-box p { margin: 4px 0; color: #0c4a6e; font-size: 14px; }
        .info-box strong { color: #0369a1; }
        .btn { display: inline-block; background: #2563eb; color: white; padding: 14px 28px; text-decoration: none; border-radius: 8px; font-weight: 600; margin: 20px 0; }
        .btn:hover { background: #1d4ed8; }
        .footer { padding: 20px 30px; background: #f9fafb; border-top: 1px solid #e5e7eb; text-align: center; }
        .footer p { color: #9ca3af; font-size: 12px; margin: 4px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Verifikasi Email Anda</h1>
            <p>Pendaftaran PPDB SMK Pariwisata Metland School</p>
        </div>
        <div class="content">
            <p>Halo <strong>{{ $student->full_name }}</strong>,</p>
            <p>Terima kasih telah mendaftar di PPDB SMK Pariwisata Metland School. Untuk melanjutkan proses pendaftaran, silakan verifikasi alamat email Anda dengan mengklik tombol di bawah ini:</p>

            <div style="text-align: center;">
                <a href="{{ $verificationUrl }}" class="btn">Verifikasi Email Saya</a>
            </div>

            <div class="info-box">
                <p><strong>Nomor Pendaftaran:</strong> {{ $student->registration_number }}</p>
                <p><strong>Nama:</strong> {{ $student->full_name }}</p>
                <p><strong>Email:</strong> {{ $student->email }}</p>
            </div>

            <p>Jika Anda tidak merasa mendaftar, abaikan email ini.</p>
            <p style="font-size: 13px; color: #9ca3af;">Jika tombol di atas tidak berfungsi, salin dan tempel link berikut ke browser Anda:<br>
            <span style="color: #2563eb; word-break: break-all;">{{ $verificationUrl }}</span></p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} SMK Pariwisata Metland School</p>
            <p>Email ini dikirim secara otomatis, mohon jangan membalas.</p>
        </div>
    </div>
</body>
</html>
