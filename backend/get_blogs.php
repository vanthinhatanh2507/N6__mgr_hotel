<?php

include 'condb.php';

class BlogController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getBlogData()
    {
        $sql = $this->buildQuery();

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

    private function buildQuery()
    {
        $type = isset($_GET['type']) && $_GET['type'] !== 'all' ? $_GET['type'] : null;
        $search = isset($_GET['search']) ? $_GET['search'] : null;
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if ($type !== null) {
            return "SELECT blog.*, COUNT(comment.star) AS star_quantity, SUM(comment.star) AS star_total
                FROM blog
                LEFT JOIN comment ON blog.id = comment.blog_id 
                WHERE `type` = '$type'
                GROUP BY blog.id;";
        } elseif ($search !== null) {
            return "SELECT blog.*, COUNT(comment.star) AS star_quantity, SUM(comment.star) AS star_total
                FROM blog
                LEFT JOIN comment ON blog.id = comment.blog_id
                WHERE blog.title LIKE '%$search%'
                GROUP BY blog.id;";
        } elseif ($id !== null) {
            return "SELECT * FROM blog WHERE `id` = '$id'";
        } elseif (isset($_GET['popular'])) {
            return "SELECT blog.*, AVG(star) AS star_avg
                FROM blog 
                LEFT JOIN comment ON blog.id = comment.blog_id
                GROUP BY blog.id
                HAVING star_avg IS NOT NULL
                ORDER BY star_avg DESC";
        } elseif (isset($_GET['recent'])) {
            return "SELECT * FROM blog ORDER BY id DESC";
        }

        // Default query (if no condition is met)
        return "SELECT blog.*, COUNT(comment.star) AS star_quantity, SUM(comment.star) AS star_total
            FROM blog 
            LEFT JOIN comment ON blog.id = comment.blog_id 
            GROUP BY blog.id;";
    }
}

// Sử dụng class BlogController
$blogController = new BlogController($conn);
$blogController->getBlogData();
?>
