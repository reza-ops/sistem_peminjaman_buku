<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

Sistem Peminjaman Buku ini adalah aplikasi untuk peminjaman buku, bisa menghitung sesuai jumlah hari peminjaman, 
disaat buku sedang di pinjam maka buku tersebut tidak bisa di pilih lagi ketika peminjaman, 
kedepan nya akan ada rekap peminajman dan memperbaiki halaman dashboard dengan grafik peminjaman, 
dan juga membuat fitur ketika peminjam terlambat mengembalikan buku akan ada hukuman (tidak bisa meminjam lagi),
saat peminjam terkena hukuman, hanya petugas yang bisa membuka status hukuman nya tersebut



Cara Untuk Install Sistem Peminjaman Mini

1. pull dari baranch development
2. composer update
3. setting .env
4. php artisan key:generate
5. php artisan migrate
6. dan langsung start dengan php artisan serve
7. masuk ke aplikasi
8. ganti url ke /registrasi (next akan ada update)


Contoh Aplikasi
fitur peminjaman
![image](https://user-images.githubusercontent.com/52590303/139216458-1e1fba80-371c-41bd-b065-578d1b7f2e28.png)
pemberitahuan transaksi berhasil
![image](https://user-images.githubusercontent.com/52590303/139216608-ed668054-d550-4d02-9114-2563f314e534.png)
fitur pengembalian
![image](https://user-images.githubusercontent.com/52590303/139216689-d2e1d217-8de1-4fff-93d4-13f9ddfcd301.png)
pengaturan master
![image](https://user-images.githubusercontent.com/52590303/139216959-ae6214e8-22a3-4e22-a9d5-7e2d9ceb1458.png)


