# Laravel Category Product

<p align="center">
<a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a>
</p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Tentang Proyek Ini

Proyek ini adalah implementasi dari sistem list produk menggunakan framework Laravel. Dalam proyek ini, Anda dapat membuat, membaca, memperbarui, dan menghapus produk yang terkait.

## Fitur

- CRUD (Create, Read, Update, Delete) untuk produk
- Validasi input menggunakan JSValidator
- Menggunakan jQuery Ajax

## Screenshoot

<img src="https://ik.imagekit.io/epras/Screenshot%202025-01-04%20010739.png?updatedAt=1735927853473" alt="logo" width="300">
<img src="https://ik.imagekit.io/epras/Screenshot%202025-01-04%20011135.png?updatedAt=1735927942043" alt="logo" width="300">

## Instalasi

1. Clone repositori ini:
   ```bash
   git clone https://github.com/krisnaepras/laravel-category-product.git
2. Masuk ke direktori proyek:
   ```bash
   cd laravel-category-product
   ```
3. Instal dependensi menggunakan Composer:
   ```bash
   composer install
   ```
4. Instal dependensi menggunakan Composer:
   ```bash
   npm install && npm run build
   ```
5. Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database:
   ```bash
   cp .env.example .env
   ```
6. Buat kunci aplikasi:
   ```bash
   php artisan key:generate
   ```
7. Migrasi database:
   ```bash
   php artisan migrate
   ```

## Penggunaan

Setelah instalasi selesai, Anda dapat menjalankan server pengembangan Laravel:
```bash
php artisan serve
```
Kemudian, buka browser dan akses `http://localhost:8000/products` untuk melihat aplikasi.
