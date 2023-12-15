<?php

include 'condb.php';

class AddController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function addHotel()
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
        $benefits = "";

        for ($i = 1; $i <= 4; $i++) {
            if (isset($_POST[$i])) {
                $benefits .= $i;
            }
        }

        $sql = "INSERT INTO hotel (name, city, price, type, max_people, quantity, rooms, des, map, benefits, img) 
                VALUES ('$name', '$city', '$price', '$type', '$max_people', '$quantity', '$rooms', '$des', '$map', '$benefits', '$img')";
        $this->executeQuery($sql, "../dashboard/hotel.php");
    }

    public function addBlog()
    {
        $title = $_POST['title'];
        $type = $_POST['type'];
        $img = $_POST['img'];
        $subtitle = $_POST['subtitle'];
        $des = $_POST['des'];
        $time = date("Y-m-d H:i:s");

        $sql = "INSERT INTO blog (title, type, img, subtitle, des, time) 
                VALUES ('$title', '$type', '$img', '$subtitle', '$des', '$time')";
        $this->executeQuery($sql, "../dashboard/blogs.php");
    }

    public function addUser()
    {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $sql = "INSERT INTO user (`name`, `username`, `password`, `email`, `phone`) 
                VALUES ('$name', '$username', '$password', '$email', '$phone')";
        setcookie("name", $name, time() + 3600, "/"); // Cookie tồn tại trong 1 giờ
        $this->executeQuery($sql, "../index.html");
    }

    public function addComment($location)
    {
        $star = $_POST['star'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $time = date("Y-m-d H:i:s");

        if (isset($_COOKIE['user_id'])) {
            $user_id = $_COOKIE['user_id'];
        } else {
            $user_id = "1";
        }

        if (isset($_GET['hotel_id'])) {
            $id = $_GET['hotel_id'];
            $sql = "INSERT INTO comment (star, title, content, time, user_id, hotel_id) 
                    VALUES ('$star', '$title', '$content','$time', '$user_id ', '$id')";
        } elseif (isset($_GET['blog_id'])) {
            $id = $_GET['blog_id'];
            $sql = "INSERT INTO comment (star, title, content, time, user_id, blog_id) 
                    VALUES ('$star', '$title', '$content','$time', '$user_id ', '$id')";
        }

        $this->executeQuery($sql, $location . "#comment");
    }

    public function addBooking()
    {
        $id = $_GET['booking_id'];

        $name = $_POST["name"];
        $gender = $_POST["gender"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $rooms = $_POST["rooms"];
        $people = $_POST["people"];
        $checkin = $_POST["checkin"];
        $checkout = $_POST["checkout"];
        $time = date("Y-m-d H:i:s");
        $user_id = 'NULL';
        if(isset($_COOKIE['user_id'])) {
            $user_id = $_COOKIE['user_id'];
        }
        $sql = "INSERT INTO booking (name, hotel_id, gender, email, phone, rooms, people, checkin, checkout, time, user_id) 
                VALUES ('$name', '$id', '$gender', '$email', '$phone', $rooms, $people, '$checkin', '$checkout', '$time', $user_id)";

        $this->executeQuery($sql, "../index.html?id");
    }

    private function executeQuery($sql, $location)
    {
        global $conn;
        if ($conn->query($sql) === TRUE) {
            header("Location: " . $location);
        } else {
            echo "Lỗi khi thêm dữ liệu: " . $conn->error;
        }

        // Đóng kết nối
        $conn->close();
    }
}

$addController = new AddController($conn);

if (isset($_GET['hotel'])) {
    $addController->addHotel();
} elseif (isset($_GET['blogs'])) {
    $addController->addBlog();
} elseif (isset($_GET['user'])) {
    $addController->addUser();
} elseif (isset($_GET['comment'])) {
    $location = isset($_GET['location']) ? $_GET['location'] : "../index.html";
    $addController->addComment($location);
} elseif (isset($_GET['booking_id'])) {
    $addController->addBooking();
}
?>
