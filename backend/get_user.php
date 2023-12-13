<?php

include 'condb.php';

class UserController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getUserData()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if ($id !== null) {
            $sql = "SELECT * FROM user WHERE `user_id` = '$id'";
        } else {
            $sql = "SELECT * FROM user";
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

// Sử dụng class UserController
$userController = new UserController($conn);
$userController->getUserData();
?>
