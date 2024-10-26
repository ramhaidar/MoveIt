<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# MoveIt

MoveIt adalah aplikasi web yang dibangun menggunakan framework Laravel. Aplikasi ini dirancang untuk mengelola layanan transportasi dan logistik, menyediakan berbagai fitur untuk pengguna dengan peran yang berbeda, seperti admin, driver, dan customer.

## Cara Kerja Aplikasi

### 1. Registrasi dan Login
- **Customer dan Driver** dapat mendaftar melalui halaman registrasi.
- Setelah registrasi, pengguna dapat login untuk mengakses fitur sesuai dengan peran mereka.

### 2. Dashboard
- **Admin**: Memiliki akses ke dashboard admin untuk mengelola pengguna, driver, dan pesanan.
- **Driver**: Memiliki akses ke dashboard driver untuk melihat dan mengelola pesanan yang ditugaskan kepada mereka.
- **Customer**: Memiliki akses ke dashboard customer untuk membuat, memproses, dan melihat riwayat pesanan.

### 3. Manajemen Pesanan
- **Customer** dapat membuat pesanan baru melalui halaman `customer-pesanan-buat`.
- Pesanan yang dibuat akan diproses dan dapat dilihat statusnya di halaman `customer-pesanan-proses`.
- Riwayat pesanan dapat dilihat di halaman `customer-pesanan-riwayat`.

### 4. E-Receipt
- **Customer** dapat melihat e-receipt untuk pesanan mereka di halaman `customer-ereceipt`.
- Admin juga dapat mengelola e-receipt melalui halaman `admin-ereceipt`.

### 5. Komplain
- **Customer** dapat mengajukan komplain terkait layanan melalui halaman `customer-komplain`.

### 6. Ganti Password
- Pengguna dapat mengganti password mereka melalui halaman `ganti-password`.

## Middleware

Aplikasi ini menggunakan beberapa middleware untuk mengamankan rute dan memastikan hanya pengguna yang berwenang yang dapat mengakses fitur tertentu:
- `Authenticate`: Memastikan pengguna sudah login.
- `IsAdminMiddleware`: Memastikan pengguna adalah admin.
- `IsCustomerMiddleware`: Memastikan pengguna adalah customer.
- `IsDriverMiddleware`: Memastikan pengguna adalah driver.
- `PreventLoggedIn`: Mencegah pengguna yang sudah login mengakses halaman tertentu.

## Instalasi

1. Clone repositori ini:
    ```sh
    git clone https://github.com/username/MoveIt.git
    ```
2. Masuk ke direktori proyek:
    ```sh
    cd MoveIt
    ```
3. Install dependensi menggunakan Composer:
    ```sh
    composer install
    ```
4. Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database:
    ```sh
    cp .env.example .env
    ```
5. Generate application key:
    ```sh
    php artisan key:generate
    ```
6. Migrasi database:
    ```sh
    php artisan migrate
    ```

## Kontribusi

Terima kasih telah mempertimbangkan untuk berkontribusi pada proyek MoveIt! Silakan baca panduan kontribusi di [dokumentasi Laravel](https://laravel.com/docs/contributions).

## Lisensi

Proyek ini dilisensikan di bawah [MIT license](https://opensource.org/licenses/MIT).

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
