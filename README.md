# Bước 1: Vào unimart/.env thay tên đường dẫn thư mục như trong file .env hướng dẫn.
- nhập đường dẫn thư mục + /public
+ APP_URL=http://localhost/unimart/public/
  
- nhập đường dẫn thư mục + /public
+ ASSET_URL = http://localhost/unimart/public/
  
- nhập tên database
+ DB_DATABASE=laravelpro_unimart

# Bước 2: import file laravelpro_unimart(1).sql vào mysql

# Bước 3: mở terminal vào đường dẫn thư mục unimart
- Để tải thư mục vendor/ nhập dòng lệnh
+ composer update
- Để chạy .env nhập các dòng lệnh
+ php artisan key:generate
+ php artisan cache:clear 
+ php artisan config:clear

#Đường dẫn web bán hàng
-http://localhost/unimart/
#Đường dẫn đến admin
-http://localhost/unimart/admin
