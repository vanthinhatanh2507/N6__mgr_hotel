<?php

include 'condb.php';

class UpdateController
{
    private $conn;
    private $id;

    public function __construct($conn, $id)
    {
        $this->conn = $conn;
        $this->id = $id;
    }

    public function updateHotel()
    {
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
                WHERE id = $this->id";

        $this->executeQuery($sql, "../dashboard/hotel.php");
    }

    public function updateBlog()
    {
        $title = $_POST['title'];
        $type = $_POST['type'];
        $img = $_POST['img'];
        $subtitle = $_POST['subtitle'];
        $des = $_POST['des'];

        $sql = "UPDATE blog SET 
                title = '$title', 
                type = '$type', 
                img = '$img', 
                subtitle = '$subtitle', 
                des = '$des'
                WHERE id = $this->id";

        $this->executeQuery($sql, "../dashboard/blogs.php");
    }

    public function updateUser()
    {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "UPDATE user SET 
                name = '$name', 
                username = '$username', 
                password = '$password'
                WHERE user_id = $this->id";

        $this->executeQuery($sql, "../dashboard/user.php");
    }

    private function executeQuery($sql, $location)
    {
        global $conn;
        if ($conn->query($sql) === TRUE) {
            header("Location: " . $location);
        } else {
            echo "Lỗi khi cập nhật dữ liệu: " . $conn->error;
        }

        // Đóng kết nối
        $conn->close();
    }
}

if (isset($_GET['hotel_id'])) {
    $updateController = new UpdateController($conn, $_GET['hotel_id']);
    $updateController->updateHotel();
} elseif (isset($_GET['blog_id'])) {
    $updateController = new UpdateController($conn, $_GET['blog_id']);
    $updateController->updateBlog();
} elseif (isset($_GET['user_id'])) {
    $updateController = new UpdateController($conn, $_GET['user_id']);
    $updateController->updateUser();
}
?>
