

# Aplikasi Inventory Warung Madura Bu Aji

## 1\. Deskripsi Aplikasi

Aplikasi ini adalah sistem **Back-End CRUD Sederhana** berbasis web yang dibangun untuk mengelola stok barang (inventory) pada sebuah toko kelontong ("Warung Madura"). Aplikasi ini memungkinkan pemilik toko untuk melakukan manajemen data produk secara digital.

### Entitas Domain

Aplikasi ini menggunakan dua entitas utama:

1.  **Entitas Utama: Produk (`Products`)**

      * Entitas ini merepresentasikan barang dagangan yang dijual di warung.
      * Atribut meliputi: Nama produk, Kategori (Sembako, Minuman, Rokok, dll), Harga, Stok, Gambar Produk, dan Status (Active/Inactive).
      * Memiliki fitur CRUD lengkap (Create, Read, Update, Delete) serta fitur pencarian (*Search*) dan filter status.

2.  **Entitas Pendukung: Pengguna (`User`)**

      * Entitas ini merepresentasikan admin atau pengelola warung.
      * Berfungsi sebagai gatekeeper keamanan aplikasi melalui proses **Autentikasi (Login & Register)**.
      * Hanya pengguna yang sudah login (terautentikasi) yang diperbolehkan mengakses menu inventory, menambah, mengubah, atau menghapus data produk.

## 2\. Spesifikasi Teknis

### Lingkungan Pengembangan

  * **Bahasa Pemrograman:** PHP 8.4.13.
  * **Basis Data:** MySQL server dan Workbench.
  * **Driver Database:** PDO (PHP Data Objects).
  * **Server:** PHP Built-in Web Server.

### Struktur Folder

Berikut adalah ringkasan struktur folder aplikasi:

```text
/ TUGAS1
├── class/              # Berisi definisi Class (OOP)
│   ├── Database.php    # Koneksi ke database
│   ├── Products.php    # Logika bisnis entitas Produk
│   ├── User.php        # Logika bisnis entitas User
│   └── Utility.php     # Fungsi bantuan (Redirect, Flash Message, ShowNav)
├── css/
│   └── style.css       # Styling dasar tampilan
├── inc/
│   └── config.php      # Konfigurasi DB dan Autoload
├── uploads/            # Folder penyimpanan gambar produk
├── schema.sql          # Struktur tabel database
├── index.php           # Halaman Dashboard/Home
├── inventory.php       # Halaman List Produk (Read)
├── create.php          # Form Tambah Produk (Create)
├── edit.php            # Form Edit Produk (Update)
├── deleteProduct.php   # Delete Produk
├── saveProduct.php     # Save Add atau Edit Data Product
├── login.php           # Halaman Login
├── logout.php          # Logout User
├── authenticate.php    # Validasi Login
├── register.php        # Halaman Registrasi
├── saveRegister.php    # Save Data Register
└── admin.php           # Halaman Daftar Admin(user yang terdaftar)
```

### Penjelasan Class Utama

1.  **`Database` (`class/Database.php`)**

      * Bertanggung jawab menangani koneksi ke database MySQL menggunakan driver **PDO**.
      * Menyediakan method `query()` untuk eksekusi perintah SQL (Prepared Statements) agar aman dari SQL Injection.

2.  **`Products` (`class/Products.php`)**

      * Merepresentasikan logika bisnis untuk entitas Produk.
      * Berisi atribut public(name, category, image_path) dan protected(id, price, stock, status)
      * Berisi method untuk operasi CRUD: `getAll()` (Read), method getter dan setter untuk atribut yang protected, `save()` (Create & Update), `delete()` (Delete), dan `search()` (Pencarian).
      * Menangani logika upload dan penghapusan file gambar dari server.

3.  **`User` (`class/User.php`)**

      * Merepresentasikan logika bisnis untuk entitas User.
      * Berisi atribut protected(id, password) lalu atriubt public(username, fullname, city, dan created_at)
      * Berisi method getter dan setter atribut password dan juga method getAll().
      * Berisi method `authenticate()` untuk memverifikasi login (cek username dan verifikasi hash password).
      * Berisi method `save()` untuk pendaftaran akun baru (Register) dengan enkripsi password (`password_hash`).

4.  **`Utility` (`class/Utility.php`)**

      * Class statis yang berisi fungsi helper.
      * `checkLogin()`: Middleware sederhana untuk memproteksi halaman dari akses tanpa login.
      * `redirect()` & `showFlash()`: Mengatur navigasi dan pesan notifikasi (sukses/gagal).
      * `showNav()`: Menngatur dan menampilkan navbar.
      * `logout()`: Untuk logout user.
      * `getPrefill()` & `clearPrefill()`: Untuk mengisi prefill dan membersihkan prefill.

## 3\. Instruksi Menjalankan Aplikasi

Ikuti langkah-langkah berikut untuk menjalankan aplikasi di komputer lokal (Localhost):

### Langkah 1: Persiapan Database

1.  Buka aplikasi manajemen database (misalnya phpMyAdmin atau Terminal).
2.  Buat database baru dengan nama `warung_madura`.
3.  Impor file `schema.sql` yang disertakan dalam proyek ini ke dalam database tersebut. File ini akan membuat tabel `users`, `products` dan mengisi satu data user default.

### Langkah 2: Konfigurasi Koneksi

1.  Buka file `inc/config.php` menggunakan teks editor.
2.  Sesuaikan konfigurasi database dengan server lokal Anda:
    ```php
    const DB_HOST = 'localhost';
    const DB_USER = 'root';       // Sesuaikan user database (default: root)
    const DB_PASS = '';           // Sesuaikan password database Anda
    const DB_NAME = 'warung_madura';
    ```

### Langkah 3: Menjalankan Server

1.  Buka terminal atau command prompt.
2.  Arahkan direktori ke folder root proyek ini.
3.  Jalankan PHP Built-in Server dengan perintah:
    ```bash
    php -S localhost:8000
    ```

### Langkah 4: Akses Aplikasi

1.  Buka browser dan kunjungi URL: `http://localhost:8000/`
2.  Anda akan diarahkan ke halaman **Login**.
3.  Gunakan akun default (dari `schema.sql`) atau daftar akun baru:
      * **Username:** `wisnuy`
      * **Password:** `igwa`

## 4\. Contoh Skenario Uji Singkat

Setelah berhasil login, Anda dapat menguji fitur CRUD sebagai berikut:

1.  **Tambah Data (Create)**

      * Masuk ke menu **Inventory**.
      * Klik tombol **"+ Add New Product"**.
      * Isi Form: Nama ("Kopi Kapal Api"), Kategori ("Minuman"), Harga (2000), Stok (50).
      * Upload gambar produk (format .jpg/.png).
      * Klik "Save Product". Data baru harus muncul di tabel.

2.  **Lihat Data & Cari (Read)**

      * Buka menu **Inventory**.
      * Pastikan data produk tampil dalam bentuk tabel lengkap dengan gambar.
      * Gunakan kolom pencarian di atas tabel, ketik "Kopi", lalu tekan Enter. Hasil harus terfilter.

3.  **Ubah Data (Update)**

      * Pada tabel Inventory, klik tombol **"Edit"** (warna kuning) pada salah satu produk.
      * Ubah harga atau stok produk.
      * (Opsional) Ganti gambar produk dengan gambar baru.
      * Klik "Update Produk". Perubahan harus tersimpan.

4.  **Hapus Data (Delete)**

      * Pada tabel Inventory, klik tombol **"Delete"** (warna merah).
      * Akan muncul konfirmasi browser ("Yakin ingin menghapus...?").
      * Klik OK. Data produk harus hilang dari tabel dan file gambar terkait terhapus dari folder `uploads/`.
