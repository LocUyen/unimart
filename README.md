# Bước 1: Vào unimart/.env thay tên đường dẫn thư mục như trong file .env hướng dẫn.

# Bước 2: import file laravelpro_unimart(1).sql vào database

# Bước 3: mở terminal vào đường dẫn thư mục unimart
- Để tải thư mục vendor/ nhập dòng lệnh
composer update
- Để chạy .env nhập các dòng lệnh
php artisan key:generate
php artisan cache:clear 
php artisan config:clear
