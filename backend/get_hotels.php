<?php

include 'condb.php';

class HotelController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getHotelData()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $city = isset($_GET['city']) ? $_GET['city'] : null;
        $type = isset($_GET['type']) ? $_GET['type'] : null;

        if ($id !== null) {
            $sql = "SELECT * FROM hotel WHERE id = $id";
        } elseif ($city !== null) {
            $sql = $this->buildCityTypeQuery($city, $type);
        } else {
            $sql = "SELECT hotel.*, COUNT(comment.star) AS star_quantity, SUM(comment.star) AS star_total, IFNULL(AVG(comment.star), 0) AS star_avg
                    FROM hotel 
                    LEFT JOIN comment ON hotel.id = comment.hotel_id GROUP BY hotel.id;";
        }

        $result = $this->conn->query($sql);
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
    }

    private function buildCityTypeQuery($city, $type)
    {
        if ($city == "Tất cả" && $type == "Tất cả") {
            return "SELECT * FROM hotel";
        } elseif ($city == "Tất cả" && $type != "Tất cả") {
            return "SELECT * FROM hotel WHERE `type` = '$type'";
        } elseif ($city != "Tất cả" && $type == "Tất cả") {
            return "SELECT * FROM hotel WHERE city = '$city'";
        } else {
            return "SELECT * FROM hotel WHERE city = '$city' AND `type` = '$type'";
        }
    }
}

// Sử dụng class HotelController
$hotelController = new HotelController($conn);
$hotelController->getHotelData();
?>
