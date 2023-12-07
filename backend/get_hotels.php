<?php
include 'condb.php';

if (isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM hotel WHERE id = $id";
} elseif(isset($_GET['city'])) {
    $city = $_GET['city'];
    $type = $_GET['type'];
    if ($city == "Tất cả" && $type == "Tất cả")
        $sql = "SELECT * FROM hotel";
    elseif ($city == "Tất cả" && $type != "Tất cả")
        $sql = "SELECT * FROM hotel WHERE `type` = '$type'";
    elseif ($city != "Tất cả" && $type == "Tất cả")
        $sql = "SELECT * FROM hotel WHERE city = '$city'";
    else
        $sql = "SELECT * FROM hotel WHERE city = '$city' AND 'type' = '$type'";
} else {
    $sql = "SELECT hotel.*,COUNT(comment.star) AS star_quantity, SUM(comment.star) AS star_total, IFNULL(AVG(comment.star), 0) AS star_avg
    FROM hotel 
    LEFT JOIN comment ON hotel.id = comment.hotel_id GROUP BY hotel.id;";
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