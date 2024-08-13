**Deskripsi:**
Repository ini berisi dasar-dasar pengembangan web berbasis **PHP native dengan pendekatan prosedural**. Di dalamnya termasuk berbagai file konfigurasi, library, dan modul penting untuk memulai proyek web berbasis PHP. Proyek ini menerapkan pola desain SVC (Service-View-Controller) atau lebih tepatnya MVC.

- **Konfigurasi Aplikasi dan Database**: Termasuk file konfigurasi utama untuk aplikasi dan pengaturan koneksi database.
  - `config/app.php`
  - `config/database.php`

- **Library Umum**: Berbagai fungsi bantu yang sering digunakan dalam pengembangan aplikasi web.
  - `libs/helpers.php`
  - `libs/flash.php` (Fitur flash message)
  - `libs/sanitization.php` (Fungsi sanitasi input)
  - `libs/validation.php` (Fungsi validasi input)
  - `libs/filter.php` (Fungsi penyaringan data)
  - `libs/connection.php` (Pengaturan koneksi database)

- **Modul Tambahan**: Modul untuk fitur spesifik seperti autentikasi pengguna dan "ingat saya" untuk sesi.
  - `auth.php`
  - `remember.php`

**Struktur Folder**:
- **app**:
  - **controllers**: Mengelola logika aplikasi dan bertindak sebagai penghubung antara services dan views.
  - **repository**: Bertanggung jawab untuk interaksi dengan database.
  - **services**: Berisi logika bisnis dan pemrosesan data.
  - **views**: Menghasilkan antarmuka pengguna dan menampilkan data.
- **config**:
  - File konfigurasi untuk aplikasi, database, dan routes.
  - `app.php`
  - `database.php`
  - `routes.php`
- **libs**: (Sumber: [PHP Tutorial](https://www.phptutorial.net/))
  - `connection.php`
  - `filter.php`
  - `flash.php`
  - `helpers.php`
  - `sanitization.php`
  - `validation.php`
- **public**:
  - **assets**
  - `.htaccess`
  - `index.php`: Entry-point aplikasi.
- `bootstrap.php`: Menginisialisasi konfigurasi dan mengatur dependensi yang dibutuhkan aplikasi.