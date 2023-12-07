<?php
include 'condb.php';

if (isset($_GET['hotel_id'])) {
    // Lấy dữ liệu từ biểu mẫu
    $id=$_GET['hotel_id'];
    
    $name = $_POST['name'];
    $city = $_POST['city'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $des = $_POST['des'];
    $img = $_POST['img'];
    $rooms = $_POST['rooms'];
    $type = $_POST['type'];
    $max_people = $_POST['max_people'];
    $map = $_POST['map'];
    // Xử lý các checkbox
    $benefits = "";
    for ($i = 1; $i <= 4; $i++) {
        if (isset($_POST[$i])) {
            $benefits .= $i;
        }
    }

    // Câu lệnh SQL UPDATE
    $sql = "UPDATE hotel SET 
            name = '$name', 
            city = '$city', 
            price = '$price', 
            quantity = '$quantity', 
            des = '$des', 
            img = '$img', 
            rooms = '$rooms', 
            type = '$type', 
            max_people = '$max_people', 
            map = '$map', 
            benefits = '$benefits' 
            WHERE id = $id";

    $location="../dashboard/hotel.php";

} elseif (isset($_GET['blog_id'])) {
    // Lấy dữ liệu từ biểu mẫu
    $id=$_GET['blog_id'];
    
    $title = $_POST['title'];
    $type = $_POST['type'];
    $img = $_POST['img'];
    $subtitle = $_POST['subtitle'];
    $des = $_POST['des'];

    // Câu lệnh SQL UPDATE
    $sql = "UPDATE blog SET 
    title = '$title', 
    type = '$type', 
    img = '$img', 
    subtitle = '$subtitle', 
    des = '$des'
    WHERE id = $id";
            
    $location="../dashboard/blogs.php";

} elseif (isset($_GET['user_id'])) {
    // Lấy dữ liệu từ biểu mẫu
    $id=$_GET['user_id'];
    
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Câu lệnh SQL UPDATE
    $sql = "UPDATE user SET 
    name = '$name', 
    username = '$username', 
    password = '$password'
    WHERE user_id = $id";
            
    $location="../dashboard/user.php";
}

if ($conn->query($sql) === TRUE) {
    header("Location: " . $location);
} else {
    echo "Lỗi khi cập nhật dữ liệu: " . $conn->error;
}

// Đóng kết nối
$conn->close();
?>
