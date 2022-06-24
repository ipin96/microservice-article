# Penjelasan Singkat

1. Pembuatan microservice article ini dengan framework lumen (laravel)
2. Buat database dengan nama "article"
3. Konfigurasi dapat dilakukan dengan mengubah isi dalam file .env , koneksikan dengan database yang telah dibuat. ubahlah pada bagian :
    DB_DATABASE= (isikan dengan nama database)
    DB_USERNAME= (isikan dengan user mysql anda, kalau menggunakan default isikan dengan "root")
    DB_PASSWORD= (isikan dengan password mysql anda, kalau default biarkan kosong)
4. Jalankan project dengan tuliskan perintah pada terminal sebagai berikut :
    - php -S localhost:8000 -t public
    - jika menggunakan vhost, panggil saja langsung nama aliasnya di url
5. Untuk mencoba hasilnya buka postman, contoh data postman dapat import file "microservice article backend postman" kedalam software postman anda.
6. Selamat mencoba  
