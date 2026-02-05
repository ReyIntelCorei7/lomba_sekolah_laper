# Panduan Mengatasi Masalah Upload Gambar Hero

## Masalah yang Ditemukan
Gambar hero section tidak berubah setelah upload melalui admin panel.

## Penyebab Masalah
1. **Storage Link**: Symlink storage belum dibuat
2. **Folder Settings**: Folder `storage/app/public/settings` belum ada
3. **Controller Logic**: Cara menangani file upload dalam array tidak tepat
4. **Database Values**: Nilai default masih menggunakan path lama

## Solusi yang Telah Diterapkan

### 1. Membuat Storage Link
```bash
php artisan storage:link
```

### 2. Membuat Folder Settings
```bash
mkdir storage/app/public/settings
```

### 3. Memperbaiki Controller Upload
File: `app/Http/Controllers/Admin/WebsiteSettingController.php`
- Mengubah cara menangani file upload dari array `settings`
- Menggunakan `$request->hasFile('settings')` dan `$request->file('settings')`
- Menangani validasi file dengan `$file->isValid()`

### 4. Memperbaiki Path Handling
File: `resources/views/layouts/app.blade.php`
- Menambahkan logic untuk menangani path storage dan public
- Menggunakan helper function untuk generate URL yang benar

### 5. Update Database dengan Path Baru
- Mengupdate nilai database dari `image/filename.png` ke `settings/filename.png`

## Cara Test Upload

### 1. Login ke Admin Panel
```
http://your-domain.com/admin/login
```

### 2. Akses Settings
```
http://your-domain.com/admin/settings
```

### 3. Upload Gambar Hero
- Scroll ke bagian "Hero Settings"
- Pilih file untuk Hero Image 1, 2, atau 3
- Klik "Save Settings"

### 4. Verifikasi Hasil
- Buka homepage untuk melihat perubahan
- Gambar hero slider seharusnya menggunakan gambar yang baru diupload

## Troubleshooting

### Jika Upload Masih Tidak Berfungsi

1. **Periksa Permissions**
```bash
chmod -R 755 storage/
chmod -R 755 public/storage/
```

2. **Periksa Storage Link**
```bash
ls -la public/storage
# Harus menunjuk ke ../storage/app/public
```

3. **Periksa Log Error**
```bash
tail -f storage/logs/laravel.log
```

4. **Clear Cache**
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Jika Gambar Tidak Muncul di Frontend

1. **Periksa Database**
- Pastikan nilai di tabel `website_settings` sudah berubah
- Path harus dimulai dengan `settings/`

2. **Periksa File Exists**
```bash
ls -la storage/app/public/settings/
```

3. **Periksa URL Generation**
- Buka browser developer tools
- Lihat apakah URL gambar benar: `/storage/settings/filename.png`

## Struktur File yang Benar

```
project/
├── public/
│   ├── storage/ -> ../storage/app/public (symlink)
│   └── image/ (gambar default lama)
├── storage/
│   └── app/
│       └── public/
│           └── settings/ (gambar upload baru)
└── database/
    └── website_settings table
        ├── hero_image_1: "settings/filename1.png"
        ├── hero_image_2: "settings/filename2.png"
        └── hero_image_3: "settings/filename3.png"
```

## Validasi Final

Setelah semua langkah di atas:

1. ✅ Storage link dibuat
2. ✅ Folder settings ada
3. ✅ Controller diperbaiki
4. ✅ Database diupdate
5. ✅ Frontend menangani path dengan benar

Upload gambar hero seharusnya sudah berfungsi normal.

---

**Catatan**: Jika masih ada masalah, periksa file permissions dan pastikan web server memiliki akses write ke folder storage.