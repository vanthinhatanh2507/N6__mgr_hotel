<?php
// Kết nối tới cơ sở dữ liệu
include 'condb.php';

// Lấy thông tin từ biểu mẫu đăng nhập
$username = $_POST['username'];
$password = $_POST['password'];

if (isset($_GET['admin'])){
    if ($username=="admin" && $password=="admin"){
        setcookie("admin", "true", time() + 3600, "/"); 
        header("Location: ../dashboard/hotel.php");
    } else {
        header("Location: ../dashboard/hotel.php?error=true");
    }    
} else {
    // Kiểm tra thông tin đăng nhập trong cơ sở dữ liệu
    $sql = "SELECT * FROM user WHERE `username` = '$username' AND `password` = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Lấy thông tin hàng đầu tiên từ kết quả truy vấn
        $row = $result->fetch_assoc();
        $name = $row["name"]; // Lấy giá trị cột "name" từ hàng dữ liệu
        $user_id = $row["user_id"]; // Lấy giá trị cột "name" từ hàng dữ liệu
        
        // Đăng nhập thành công, thiết lập cookie với tên dựa trên "name"
        setcookie("name", $name, time() + 3600, "/"); // Cookie tồn tại trong 1 giờ
        setcookie("user_id", $user_id, time() + 3600, "/"); // Cookie tồn tại trong 1 giờ
        header("Location: ../index.html"); // Chuyển hướng đến trang index.php
    } else {
        header("Location: ../index.html?error=true");
    }
    $conn->close();
}
?>
