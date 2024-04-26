# TP3DPBO2024C1

# README

## Deskripsi Program

Program ini adalah sebuah sistem manajemen data restoran yang bertujuan untuk mengelola informasi tentang chef, menu, dan jabatan di sebuah restoran. Program ini dibangun menggunakan bahasa pemrograman PHP dan database MySQL.

## Desain Program

### Struktur Direktori

- `config`: Direktori untuk menyimpan file konfigurasi, seperti koneksi ke database.
- `classes`: Direktori untuk menyimpan file kelas PHP yang mengelola operasi-operasi terkait dengan database.
- `templates`: Direktori untuk menyimpan file-template HTML yang digunakan untuk menampilkan halaman web.
- `assets`: Direktori untuk menyimpan aset-aset, seperti gambar dan file CSS/JavaScript.

### Kelas-kelas Utama

1. `DB.php`: Kelas untuk mengelola koneksi ke database MySQL.
2. `Chef.php`: Kelas untuk mengelola operasi-operasi terkait dengan chef, seperti menambah, mengedit, menghapus, dan mendapatkan data chef dari database.
3. `Menu.php`: Kelas untuk mengelola operasi-operasi terkait dengan menu, seperti menambah, mengedit, menghapus, dan mendapatkan data menu dari database.
4. `Jabatan.php`: Kelas untuk mengelola operasi-operasi terkait dengan jabatan, seperti menambah, mengedit, menghapus, dan mendapatkan data jabatan dari database.
5. `Template.php`: Kelas untuk mengelola proses rendering halaman web menggunakan template HTML.

### Alur Kerja

1. Pengguna mengakses halaman web utama (misalnya `index.php`) melalui browser.
2. Halaman web utama menampilkan berbagai pilihan menu, seperti manajemen chef, manajemen menu, dan manajemen jabatan.
3. Pengguna memilih salah satu menu, misalnya daftar chef.
4. Halaman chef (`chef.php`) memperlihatkan daftar chef yang ada di restoran.
5. Pengguna dapat melakukan berbagai operasi, seperti menambah, mengedit, atau menghapus chef.
6. Setiap operasi yang dilakukan oleh pengguna akan memicu interaksi dengan server PHP yang memproses permintaan dan mengubah data di database jika diperlukan.
7. Hasil dari operasi yang dilakukan akan ditampilkan kembali kepada pengguna melalui halaman web.

### Fitur
- Sorting Jabatan
- Searching Jabatan
- Downlod Data Chef

## Screenshots
![Screenshot_1](https://github.com/arulzkash/TP3DPBO2024C1/assets/73780374/39785b44-e3f7-47e4-b9a7-892396f1b11c)
![Screenshot_4](https://github.com/arulzkash/TP3DPBO2024C1/assets/73780374/ae909b9e-4d4b-4679-ba18-f61c7e434fc8)
![Screenshot_2](https://github.com/arulzkash/TP3DPBO2024C1/assets/73780374/f611b2f1-ad61-4fdd-8b96-d292a8ba3ee8)
![Screenshot_3](https://github.com/arulzkash/TP3DPBO2024C1/assets/73780374/94cfe759-2577-419d-b039-217baf137c7b)

## Screenrecords

https://github.com/arulzkash/TP3DPBO2024C1/assets/73780374/56a24146-cfd8-4c55-9b0b-bb8ee96f2a3c





