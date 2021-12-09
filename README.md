<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

SISTEM PEMINJAMAN BUKU adalah sebuah sistem aplikasi berbasis website untuk transaksi peminjaman buku

Fitur utama SISTEM PEMINJAMAN
1. Login
2. Management buku 
3. Cetak kode buku untuk di tempel di buku berbentuk barcode
4. Management pengunjung/peminjam
5. Transaksi peminjaman, 
6. Struk peminjaman sebagai bukti transaksi
7. Menu pengembalian, ketika terlambat mengembalikan pengunjung/peminjam akan terkena hukuman 
8. Update status pengujung/peminjam yang terkena hukuman
9. Sebelum buku di kembalikan buku tidak bisa di pinjam
10. Grafik halaman dashboard yang menampilkan informasi seputar transaksi



Cara Untuk Install SISTEM PEMINJAMAN

1. pull dari baranch development
2. composer update
3. setting .env
4. php artisan key:generate
5. php artisan migrate
6. dan langsung start dengan php artisan serve
7. masuk ke aplikasi
8. register
9. masuk ke dashboard


Contoh Dashboard
![image](https://user-images.githubusercontent.com/52590303/145346413-a151a531-137f-4f4e-b044-177465dcf3ab.png)
