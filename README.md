# bukuku

## Deskripsi

Website yang saya buat ini adalah untuk memenuhi salah satu syarat kompeten dalam pelatihan kompetensi guru RPL. Silakan dikembangkan untuk keperluan apa pun selama itu baik.

**Akun Admin (default):**

- Username: `admin`
- Password: `admin`

---

## Cara Instalasi & Menjalankan di Local Server (XAMPP)

### 1) Simpan project di folder htdocs

1. Pastikan XAMPP sudah terpasang.
2. Salin folder project ini ke:
   - `C:\xampp\htdocs\bukuku`

> Jika folder namanya berbeda, pastikan URL yang digunakan juga menyesuaikan.

### 2) Buat database MySQL

1. Buka browser dan masuk ke:
   - `http://localhost/phpmyadmin`
2. Buat database baru dengan nama: **`tokobuku`**
3. Import file database:
   - Pilih menu **Import**
   - Pilih file `tokobuku.sql` yang berada di dalam folder project ini
   - Jalankan proses import

### 3) Pastikan konfigurasi koneksi database

Pastikan file koneksi database sesuai dengan nama database Anda.

- Cek: `data/connection.php`

Biasanya yang perlu diperiksa:

- nama database: `tokobuku`
- host (umumnya `localhost`)
- username password MySQL (sesuaikan dengan konfigurasi XAMPP Anda)

### 4) Jalankan aplikasi

1. Nyalakan service **Apache** dan **MySQL** pada XAMPP.
2. Buka browser dan akses:
   - `http://localhost/bukuku/`

---

## Cara Pakai Aplikasi

### A. Penggunaan Umum (Pengunjung/User)

1. Buka halaman utama `index.php`.
2. Pilih kategori buku melalui menu yang tersedia.
3. Lihat daftar buku (hasil dari `listbuku.php` / halaman terkait).
4. Tambahkan buku ke **Cart** (keranjang) melalui halaman/cart yang disediakan.
5. Lakukan **Checkout** untuk memproses pesanan.
6. Cek riwayat/daftar pesanan pada halaman daftar pesanan (jika tersedia).

### B. Registrasi & Login

- Jika aplikasi menyediakan pendaftaran, lakukan **Register** untuk membuat akun user baru.
- Lakukan **Login** untuk mengakses fitur yang membutuhkan autentikasi.

File terkait:

- `register.php` / `register_aksi.php`
- `login_aksi.php`

### C. Penggunaan Admin

1. Login sebagai admin.
2. Setelah berhasil login, admin bisa mengelola:
   - **Buku**: tambah/update/hapus data buku (modul CRUD)
     - file contoh: `buku_create.php`, `buku_update.php`, `buku_delete.php`
   - **Kategori Buku**: tambah/update/hapus kategori
     - file contoh: `kategori_buku_create.php`, `kategori_buku_update.php`, `kategori_buku_delete.php`
   - **Data Pesanan & User**
     - file contoh: `list_pesanan.php`, `list_user.php`

---

## Struktur File Penting

- `index.php` : halaman utama
- `cart.php` / `cart_aksi.php` : keranjang & aksi cart
- `checkout_aksi.php` : proses checkout
- `listbuku.php` : daftar buku
- `kategori_buku.php` : daftar kategori
- `buku_*.php` : halaman admin untuk CRUD buku
- `kategori_buku_*.php` : halaman admin untuk CRUD kategori
- `list_pesanan.php` : daftar/kelola pesanan
- `list_user.php` : daftar user
- `data/connection.php` : koneksi database

---

## Catatan

- Jika ingin melihat langsung aplikasi [buildwithabi.free.je](https://buildwithabi.free.je/listbuku.php)
- Pastikan database `tokobuku` sudah terimport agar aplikasi dapat berjalan.
- Jika terjadi error koneksi database, periksa kembali konfigurasi pada `data/connection.php`.
