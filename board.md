# TẠO BẢNG DL TRONG PHÂN QUYỀN

##  permissions
- id
- name
- slug (post.add)
- description ->nullable

## role
- id
- name
- description

## role_permissions
- id
- role_id (FK)
- permission_id (FK)

## user_role
- id
- role_id (FK)
- user_id (FK)

### Add menu sidebar admin
Phân quyền
>> Quyền
>> Thêm vai trò
>> DS các vai trò

## checklist module permissions
> Add permissions
1. have templates
2. create controller
- add
- store 

3. create routes 
- add
- store

4. create view
5. validate
6. insert data
- add fillable model
- create
- redirect
- show alert

7. show view
...$permissions ở controller (Groups)
...gửi data qua view
...xuất ra view 

>> edit permissions
- controller edit
---edit ->load dl
---update -> cập nhật dl

- route
---edit
---update

- add link edit vào list name add
- tạo view
- gửi dl qua view
- add link update vào form
- validation
- update
- chuyển hướng
- thông báo

>> delete permissions
- controller - delete
- route
- add link delete vào button
- confirm - xác nhận muốn xóa
- xử lý xóa
- chuyển hướng
- thông báo


## checklist module role
>> show list role
1. route
2. create controller
3. fillable module role, add use Role model
4. get data
5. create view
6. ghép giao diện
7. truyền dl


>> add role
1. route role
- add role
- store role

2. controller
- add role
- store role

3. get permission
4. create view
5. ghép giao diện
6. đổ dl
7. validation form
8. create new role
9. redirect list role
10. alert status role

## relationship
- 1->N : has Many
- N->1 : belongTo
- N->N : belongsToMany

>> edit role
1. route
- edit role
- update role

2. controller
- edit role -> load dl từ data
- update role -> cập nhật dl

3. add link edit vào ds
4. tạo view
5. gửi dl qua view
- permission
- role
6. validation
7. update
- role
- role_permission
8. chuyển hướng
9. thông báo

>>delete role
1. route delete role
2. controller delete
3. link delete role
4. comfirm delete role
5. xử lý xóa
6. chuyển hướng
7. thông báo


## User role
>> update user
1. route
- edit
- update
2. controller
- edit 
- update
3. tạo và gửi dl sang view
- admin.user.edit
- roles
4. Validation
5. update
- user
- user_role
6. chuyển hướng
7. thông báo

## Phân quyền với Gate(Define + check)
1. Cách làm việc với Gate
- định nghĩa
- kiểm tra quyền
2. Tư duy áp dụng Gate trong hệ thống phân quyền
3. Định nghĩa Gate bằng vòng lặp
4. Test kiểm tra quyền tại controller
5. Ktra quyền tại route
6. Kiểm tra quyền Blade Sidebar Menu
