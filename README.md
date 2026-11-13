# AJARA — Ajang dan Jejaring Prestasi Mahasiswa

AJARA adalah platform informasi kompetisi mahasiswa berbasis Laravel 12. Paket ini merupakan pengerjaan **Tahap 1 (frontend mahasiswa)** dengan landing page, katalog lomba, filter, card poster, dan detail kompetisi. Struktur autentikasi dan dashboard bawaan project tetap dipertahankan untuk tahap berikutnya.

## Teknologi
- Laravel 12, PHP 8.2+
- MySQL (XAMPP/phpMyAdmin) atau SQLite untuk pengembangan
- Blade, Tailwind CSS CDN, Bootstrap Icons

## Menjalankan project di XAMPP
1. Ekstrak folder `ajara` ke `C:\xampp\htdocs\ajara`.
2. Buka terminal pada folder project, lalu jalankan `composer install` jika folder `vendor` belum tersedia.
3. Salin `.env.example` menjadi `.env` jika belum ada, lalu sesuaikan koneksi database MySQL yang sudah dibuat melalui phpMyAdmin. Jangan mengganti kredensial database yang sudah benar.
4. Jalankan `php artisan key:generate` hanya jika `APP_KEY` masih kosong.
5. Jalankan migration dan data demo:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```
6. Jalankan website:
   ```bash
   php artisan serve
   ```
7. Buka `http://127.0.0.1:8000`.

## Halaman Tahap 1
- `/` — Landing page AJARA.
- `/lomba` — Katalog lomba, pencarian, filter kategori, tingkat, metode, biaya, status, dan sorting.
- `/lomba/{id}` — Detail kompetisi.

## Akun demo
Seeder membuat akun mahasiswa:
- Email: `amanda@example.com`
- Password: `password123`

## Logo dan poster
Logo resmi yang disediakan disimpan di `public/images/ajara-logo.jpeg`. Poster demo memakai URL gambar publik sebagai placeholder visual; ganti `banner` dengan URL atau path poster lomba resmi saat data nyata tersedia.

## Catatan tahap ini
- Data katalog berasal dari tabel `competitions`, bukan ditulis satu per satu di Blade.
- Migration tambahan `2026_11_09_000005_add_discovery_fields_to_competitions_table.php` menambahkan kategori lomba, tingkat, metode hybrid, biaya, rating, ulasan, views, rekomendasi, dan persyaratan.
- Rating saat ini merupakan data demo. Sistem ulasan/rating mahasiswa dan penyimpanan favorit permanen akan dibangun pada tahap fungsionalitas berikutnya.
- Styling memakai Tailwind CDN agar frontend bisa langsung dilihat tanpa proses build Node/Vite.
