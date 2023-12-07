<?php
include 'condb.php';

if (isset($_GET['hotel'])) {
    // Lấy dữ liệu từ biểu mẫu
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
    // Câu lệnh SQL INSERT
    $sql = "INSERT INTO hotel (name, city, price, type, max_people, quantity, rooms, des, map, benefits, img) 
            VALUES ('$name', '$city', '$price', '$type', '$max_people', '$quantity', '$rooms', '$des', '$map', '$benefits', '$img')";
    $location = "../dashboard/hotel.php";
} elseif (isset($_GET['blogs'])) {
    // Lấy dữ liệu từ biểu mẫu
    $title = $_POST['title'];
    $type = $_POST['type'];
    $img = $_POST['img'];
    $subtitle = $_POST['subtitle'];
    $des = $_POST['des'];
    $time = date("Y-m-d H:i:s"); // Lấy thời gian hiện tại
    // Câu lệnh SQL INSERT
    $sql = "INSERT INTO blog (title, type, img, subtitle, des, time) 
            VALUES ('$title', '$type', '$img', '$subtitle', '$des', '$time')";
    $location = "../dashboard/blogs.php";
} elseif (isset($_GET['user'])) {
    // Lấy dữ liệu từ biểu mẫu
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Câu lệnh SQL INSERT
    $sql = "INSERT INTO user (name, username, password) 
            VALUES ('$name', '$username', '$password')";

    setcookie("name", $name, time() + 3600, "/"); // Cookie tồn tại trong 1 giờ
    $location = "../index.html";
} elseif (isset($_GET['comment'])) {
    $star = $_POST['star'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $time = date("Y-m-d H:i:s"); // Lấy thời gian hiện tại
    if (isset($_COOKIE['user_id']))
        $user_id = $_COOKIE['user_id'];
    else
        $user_id = "1";
    if (isset($_GET['hotel_id'])) {
        $id = $_GET['hotel_id'];
        $sql = "INSERT INTO comment (star, title, content, time, user_id, hotel_id) 
                VALUES ('$star', '$title', '$content','$time', '$user_id ', '$id')";
    } elseif (isset($_GET['blog_id'])) {
        $id = $_GET['blog_id'];
        $sql = "INSERT INTO comment (star, title, content, time, user_id, blog_id) 
                VALUES ('$star', '$title', '$content','$time', '$user_id ', '$id')";
    }
    $location = $_GET['location'] . "#comment";

} elseif (isset($_GET['booking_id'])) {
    $id = $_GET['booking_id'];

    $name = $_POST["name"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $rooms = $_POST["rooms"];
    $people = $_POST["people"];
    $checkin = $_POST["checkin"];
    $checkout = $_POST["checkout"];
    $time = date("Y-m-d H:i:s"); // Lấy thời gian hiện tại

    // Thêm dữ liệu vào cơ sở dữ liệu
    $sql = "INSERT INTO booking (name, hotel_id, gender, email, phone, rooms, people, checkin, checkout, time) VALUES ('$name', '$id', '$gender', '$email', '$phone', $rooms, $people, '$checkin', '$checkout', '$time')";

    $location = "../index.html?id";
}


// Thực hiện câu lệnh INSERT
if ($conn->query($sql) === TRUE) {
    header("Location: " . $location);
} else {
    echo "Lỗi khi thêm dữ liệu: " . $conn->error;
}

// Đóng kết nối
$conn->close();
