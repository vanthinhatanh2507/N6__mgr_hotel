<?php
include 'condb.php';

if (isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM user WHERE `user_id` = '$id'";
} else {
    $sql = "SELECT * FROM user";
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