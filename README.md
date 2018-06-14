# Allied Tech Base

## Mô tả: 
- Demo về User Authentication, Authorization
- Framework: Yii2 -> tốc độ gần như tốt nhất, dễ học
- Database: MySql 

## Hướng dẫn cài đặt
- Cài đặt LAMP stack (có thể sử dụng Nginx thay cho Apache)
- Import database trong thư mục `db/`
- Chạy `composer` trong thư mục `src/`
- Chỉnh sửa thông tin database trong `src/environments/dev/common/config/main-local.php`
- Chạy lệnh `php init`, chọn môi trường `development `
- Setup virtual host, document root trỏ vào `src/mobile/web`

## Test
- Sử dụng Postman import collection trong thư mục root 

### Các functions:
- (POST) Login: `http://your_virtual_host/version1/staff/login`
- (GET) Get account detail: `http://your_virtual_host/version1/staff/detail`
- (POST) Update info: `http://your_virtual_host/version1/staff/update`

Các params, header có trong Postman. 

Hapy Coding :D
