# 1. kiểm tra đăng nhập
Auth::check();
# 2. kiểm tra login
Auth::login($user);
# 3. kiểm tra login nếu biết id
Auth::loginUsingId($user);
# 4. kiểm tra thông tin login theo yêu cầu
Auth::attempt([
    'email' => $email,
    'username' => $username,
    'password' => $password
]);
# 5. lấy thông tin user
Auth::user()->trường muốn lấy;
# 6. lấy id
Auth::id();
# 7. logout
Auth::logout();