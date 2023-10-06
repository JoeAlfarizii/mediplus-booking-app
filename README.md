<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Mediplus Booking App

Step Instalasi

- Lakukan clone project $ git clone https://github.com/JoeAlfarizii/mediplus-booking-app.git
- open folder project yang sudah di clone dengan perintah $ cd mediplus-booking-app
- Jalankan Perintah $ composer install untuk instalasi vendor module
- Selanjutnya Jalankan Perintah $ npm install untuk instalasi JS package node_module
- copy file env example agar menjadi .env dengan perintah $ cp .env.example .env
- atur .env file dengan ubah APP_URL sesuai dengan port yang anda gunakan (by default, gunakan http://localhost:8000) dan set DB_DATABASE sesuai nama db baru anda ( anda harus membuat DB baru di local terlebih dahulu)
- Generate key app dengan perintah $ php artisan key:generate
- jalankan perintah $ php artisan migrate::fresh --seed
- jalankan perintah untuk create symlink folder $ php artisan link:storage
- lankan perintah $ php artisan serve dan jalankan vite dengan open new terminal $ npm run dev

## Demo account yang bisa digunakan

User Credential : 

email : hasan@mail.com
password : secret

Admin Credential : 

email : admin.maul@mail.com
password : secret

email : admin.malik@mail.com
password : secret