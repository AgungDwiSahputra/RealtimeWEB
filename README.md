# CodeIgniter 4 Application Realtime WEB

## Server Requirements
PHP version 7.3 or higher is required

## Install Steps
1. Install XAMPP, dan NODEJS.
2. Run Apache dan MySQL (default : XAMPP).
3. Install database pada "http://localhost/phpmyadmin" dengan nama yang disesuaikan,
   (default nama DB : realtime_app),
   (default username DB : root),
   (default password DB : ).
   **Jika ada perbedaan dengan default maka perlu di setting pada file ".env", ubah pada line 41-44.
4. Pada folder "SERVER_JS" buka terminal lalu install dependencies(express,socket.io,winston) dengan perintah "npm install".
5. Pada terminal yang sama ketikan perintah "node server.js" untuk menjalankan server.
   **Biarkan terminal tetap hidup[JANGAN DI CLOSE].
6. Lalu, Buka folder "realtime_ci4" buka terminal lalu run website dengan perintah "php spark serve", (default berjalan di : http://localhost:8080/).
7. Buka browser dan ketikan http://localhost:8080 pada url. 

Selesai...

** Jika terjadi error pastikan path PHP telah di tambahkan
** Jika terjadi error di luar itu maka perlu mengaktifkan intl pada php.ini di Xampp

/* AKUN ADMIN */
username : admin
password : admin
