<?php
include 'condb.php';

if (isset($_GET['hotel_id'])) {
    // Lấy dữ liệu từ biểu mẫu
    $id=$_GET['hotel_id'];

    $sql = "DELETE FROM hotel WHERE id = $id";

    $location="../dashboard/hotel.php";

} elseif (isset($_GET['blog_id'])) {
    // Lấy dữ liệu từ biểu mẫu
    $id=$_GET['blog_id'];

    $sql = "DELETE FROM blog WHERE id = $id";
            
    $location="../dashboard/blogs.php";

} elseif (isset($_GET['comment_id'])) {
    // Lấy dữ liệu từ biểu mẫu
    $id=$_GET['comment_id'];

    $sql = "DELETE FROM comment WHERE comment_id = $id";
            
    $location="../dashboard/comments.php";

} elseif (isset($_GET['booking_id'])) {
    // Lấy dữ liệu từ biểu mẫu
    $id=$_GET['booking_id'];

    $sql = "DELETE FROM booking WHERE id = $id";
            
    $location="../dashboard/booking.php";

} elseif (isset($_GET['user_id'])) {
    // Lấy dữ liệu từ biểu mẫu
    $id=$_GET['user_id'];

    $sql = "DELETE FROM user WHERE user_id = $id";
            
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
