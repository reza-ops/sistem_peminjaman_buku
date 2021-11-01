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
8. register
9. masuk ke dashboard


Contoh Aplikasi <br>
login
![image](https://user-images.githubusercontent.com/52590303/139620683-73df69f2-c52c-4b6f-91ff-ab49b4ad7f8a.png)
login error
![image](https://user-images.githubusercontent.com/52590303/139620741-bc2a296f-c25e-41f3-af8d-4b68920d2b6d.png)
register![image](https://user-images.githubusercontent.com/52590303/139620815-004ca30e-69eb-42f4-88e9-122faf1c5708.png)
fitur peminjaman
![image](https://user-images.githubusercontent.com/52590303/139216458-1e1fba80-371c-41bd-b065-578d1b7f2e28.png)
pemberitahuan transaksi berhasil
![image](https://user-images.githubusercontent.com/52590303/139216608-ed668054-d550-4d02-9114-2563f314e534.png)
fitur pengembalian
![image](https://user-images.githubusercontent.com/52590303/139216689-d2e1d217-8de1-4fff-93d4-13f9ddfcd301.png)


