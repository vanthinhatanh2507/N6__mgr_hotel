<?php

include 'condb.php';

class DeleteController
{
    private $conn;
    private $id;
    private $location;

    public function __construct($conn, $id, $location)
    {
        $this->conn = $conn;
        $this->id = $id;
        $this->location = $location;
    }

    public function deleteHotel()
    {
        $sql = "DELETE FROM hotel WHERE id = $this->id";
        $this->executeQuery($sql);
    }

    public function deleteBlog()
    {
        $sql = "DELETE FROM blog WHERE id = $this->id";
        $this->executeQuery($sql);
    }

    public function deleteComment()
    {
        $sql = "DELETE FROM comment WHERE comment_id = $this->id";
        $this->executeQuery($sql);
    }

    public function deleteBooking()
    {
        if (isset($_GET['user'])){
            $this->location = '../profile.html';
        }
        $sql = "DELETE FROM booking WHERE id = $this->id";
        $this->executeQuery($sql);
    }

    public function deleteUser()
    {
        $sql = "DELETE FROM user WHERE user_id = $this->id";
        $this->executeQuery($sql);
    }

    private function executeQuery($sql)
    {
        global $conn;
        if ($conn->query($sql) === TRUE) {
            header("Location: " . $this->location);
        } else {
            echo "Lỗi khi xóa dữ liệu: " . $conn->error;
        }

        // Đóng kết nối
        $conn->close();
    }
}

if (isset($_GET['hotel_id'])) {
    $deleteController = new DeleteController($conn, $_GET['hotel_id'], "../dashboard/hotel.php");
    $deleteController->deleteHotel();
} elseif (isset($_GET['blog_id'])) {
    $deleteController = new DeleteController($conn, $_GET['blog_id'], "../dashboard/blogs.php");
    $deleteController->deleteBlog();
} elseif (isset($_GET['comment_id'])) {
    $deleteController = new DeleteController($conn, $_GET['comment_id'], "../dashboard/comments.php");
    $deleteController->deleteComment();
} elseif (isset($_GET['booking_id'])) {
    $deleteController = new DeleteController($conn, $_GET['booking_id'], "../dashboard/booking.php");
    $deleteController->deleteBooking();
} elseif (isset($_GET['user_id'])) {
    $deleteController = new DeleteController($conn, $_GET['user_id'], "../dashboard/user.php");
    $deleteController->deleteUser();
}
?>
