# Prediksi Kehadiran Mahasiswa

Aplikasi web Laravel untuk menampilkan estimasi persentase kehadiran mahasiswa berdasarkan tiga parameter akademik. Antarmuka menggunakan tema cokelat premium, logo resmi Politeknik Caltex Riau, dan modal hasil prediksi.

## Teknologi

- PHP 8.2 atau lebih baru
- Laravel 11
- Blade
- CSS modern
- JavaScript Fetch API (tanpa library frontend tambahan)
- Asset frontend statis yang dilayani langsung oleh Laravel (tanpa bundler JavaScript)
- SQLite sebagai konfigurasi database bawaan Laravel (fitur prediksi tidak menyimpan hasil ke database)

## Struktur fitur

- `resources/views/prediction_form.blade.php` — struktur antarmuka dan form prediksi.
- `public/css/app.css` — design tokens, layout responsif, card, modal, dan animasi.
- `public/js/app.js` — pengiriman form AJAX, loading state, error handling, dan kontrol modal.
- `public/images/logo-pcr-unggul.webp` — logo Politeknik Caltex Riau yang diberikan pengguna.
- `app/Http/Controllers/AttendancePredictionController.php` — aturan prediksi asli.
- `routes/web.php` — endpoint asli (`GET /` dan `POST /predict`).

## Persyaratan sistem

- PHP 8.2+ dengan ekstensi PHP yang dibutuhkan Laravel 11 (minimal `ctype`, `curl`, `dom`, `fileinfo`, `filter`, `hash`, `mbstring`, `openssl`, `pcre`, `PDO`, `session`, `tokenizer`, dan `xml`).
- Composer 2.
- Tidak memerlukan Node.js/npm untuk menjalankan antarmuka aplikasi.
- Web server lokal atau PHP built-in server.

## Instalasi dari awal

1. Ekstrak ZIP project.
2. Buka terminal di folder project (folder yang berisi `artisan`, `composer.json`, dan `composer.lock`).
3. Pasang dependency PHP:

   ```bash
   composer install
   ```

4. Buat file environment:

   **macOS / Linux**

   ```bash
   cp .env.example .env
   ```

   **Windows PowerShell**

   ```powershell
   Copy-Item .env.example .env
   ```

5. Buat application key:

   ```bash
   php artisan key:generate
   ```

6. Jalankan aplikasi Laravel:

   ```bash
   php artisan serve
   ```

7. Buka `http://127.0.0.1:8000`.

## Persiapan production

Tidak ada langkah bundling frontend karena CSS dan JavaScript dilayani langsung dari folder `public/`. Pastikan seluruh file di folder tersebut ikut diunggah. Atur environment production pada server:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domain-anda.example
```

Pastikan document root web server mengarah ke folder `public`, dan jalankan perintah optimasi Laravel setelah konfigurasi environment production selesai:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Jangan pernah mengunggah file `.env` lokal atau credentials ke repository publik.

## Database

Fitur prediksi pada versi ini menerima tiga input dan mengembalikan respons JSON. Controller asli tidak menyimpan hasil prediksi ke database, sehingga database tidak diperlukan untuk melakukan prediksi. Konfigurasi `.env.example` menggunakan session dan cache berbasis file serta queue sync agar aplikasi lokal dapat dijalankan tanpa tabel session/cache/queue.

Jika Anda ingin menjalankan seluruh migration Laravel, buat database SQLite terlebih dahulu:

**macOS / Linux**

```bash
mkdir -p database
touch database/database.sqlite
php artisan migrate
```

**Windows PowerShell**

```powershell
New-Item -ItemType File -Path database/database.sqlite -Force
php artisan migrate
```

## Endpoint prediksi

- `GET /` — halaman form.
- `POST /predict` — menerima form dengan field `on_time_frequency`, `semester_compensations`, dan `organization_absences`; mengembalikan JSON dengan key `message`.

Nilai opsi form dipertahankan sesuai backend asli:

- Frekuensi hadir tepat waktu: `Selalu`, `Jarang`, `Tidak Pernah`.
- Jumlah kompen: `0 - 5 jam`, `6 - 9 jam`, `> 10 jam`.
- Absen karena organisasi: `Tidak Pernah`, `Jarang`, `Selalu`.

Aturan dan keluaran prediksi tidak diubah dalam pekerjaan redesign ini. Jika suatu kombinasi belum memiliki aturan di controller, hasilnya tetap `Tidak diketahui`.

## Pengujian

Setelah dependency PHP terpasang, jalankan:

```bash
php artisan test
```

Feature test mencakup rendering halaman, asset logo, kontrak respons JSON endpoint, satu aturan prediksi yang sudah ada, dan kombinasi yang memang belum memiliki aturan. CSS dan JavaScript tidak memerlukan proses build terpisah.

## Catatan desain dan aksesibilitas

- Palet warna utama menggunakan brown, dark brown, caramel, warm beige, dan ivory.
- Layout desktop dirancang agar header, konten, dan footer muat dalam satu viewport pada ukuran desktop yang ditargetkan; pada layar kecil konten mengalir secara vertikal dan scrolling tetap diperbolehkan.
- Modal menggunakan elemen HTML `<dialog>` native, dapat ditutup melalui tombol, klik backdrop, atau Escape.
- Hasil server dimasukkan menggunakan `textContent`, bukan HTML injection.
- Animasi menghormati preferensi `prefers-reduced-motion`.
- Logo PCR disimpan secara lokal dan ditampilkan dengan `object-fit: contain`.
