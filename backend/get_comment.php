<?php
include 'condb.php';

if (isset($_GET['hotel_id'])){
    $hotel_id = $_GET['hotel_id'];
    $sql = "SELECT * FROM user JOIN comment ON user.user_id = comment.user_id WHERE `hotel_id` = $hotel_id";
} elseif (isset($_GET['blog_id'])) {
    $blog_id = $_GET['blog_id'];
    $sql = "SELECT * FROM user JOIN comment ON user.user_id = comment.user_id WHERE `blog_id` = $blog_id";
} else {
    $sql = "SELECT comment.*, hotel.name AS hotel_name, user.name AS user_name, blog.title AS blog_title, hotel.img AS hotel_img, blog.img AS blog_img FROM comment 
    JOIN user ON user.user_id = comment.user_id 
    LEFT JOIN hotel ON hotel.id = comment.hotel_id 
    LEFT JOIN blog ON blog.id= comment.blog_id;";
}


$result = $conn->query($sql);
$data = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    } else {
        echo "Không có dữ liệu";
    }

// Trả về dữ liệu dưới dạng JSON
header('Content-Type: application/json');
echo json_encode($data);

// Đóng kết nối đến cơ sở dữ liệu
$result->close();
?>