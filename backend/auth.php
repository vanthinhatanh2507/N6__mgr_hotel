<?php

// Kết nối tới cơ sở dữ liệu
include 'condb.php';

class LoginController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function login()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (isset($_GET['admin'])) {
            $this->loginAdmin($username, $password);
        } else {
            $this->loginUser($username, $password);
        }
    }

    private function loginAdmin($username, $password)
    {
        if ($username == "admin" && $password == "admin") {
            setcookie("admin", "true", time() + 3600, "/");
            header("Location: ../dashboard/hotel.php");
        } else {
            header("Location: ../dashboard/hotel.php?error=true");
        }
    }

    private function loginUser($username, $password)
    {
        $sql = "SELECT * FROM user WHERE `username` = '$username' AND `password` = '$password'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row["name"];
            $user_id = $row["user_id"];

            setcookie("name", $name, time() + 3600, "/");
            setcookie("user_id", $user_id, time() + 3600, "/");
            header("Location: ../index.html");
        } else {
            header("Location: ../index.html?error=true");
        }

        $this->conn->close();
    }
}

$loginController = new LoginController($conn);
$loginController->login();
?>
