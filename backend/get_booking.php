<?php

include 'condb.php';

class BookingController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getBookingData()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if ($id !== null) {
            $sql = "SELECT booking.*, hotel.name AS hotel_name, hotel.price, hotel.max_people, hotel.img
                    FROM booking
                    LEFT JOIN hotel ON hotel.id = booking.hotel_id
                    WHERE booking.id = '$id'";
        } else {
            $sql = "SELECT booking.*, hotel.name AS hotel_name, hotel.price, hotel.max_people, hotel.img
                    FROM booking
                    LEFT JOIN hotel ON hotel.id = booking.hotel_id";
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
}

// Sử dụng class BookingController
$bookingController = new BookingController($conn);
$bookingController->getBookingData();
?>
