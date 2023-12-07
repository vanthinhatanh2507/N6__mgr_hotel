<?php
include 'condb.php';

if (isset($_GET['type']) AND $_GET['type'] != 'all'){
    $type = $_GET['type'];
    $sql = "SELECT blog.*, COUNT(comment.star) AS star_quantity, SUM(comment.star) AS star_total
    FROM blog
    LEFT JOIN comment ON blog.id = comment.blog_id 
    WHERE `type` = '$type'
    GROUP BY blog.id;";
} else {
    $sql = "SELECT blog.*,COUNT(comment.star) AS star_quantity, SUM(comment.star) AS star_total
    FROM blog 
    LEFT JOIN comment ON blog.id = comment.blog_id GROUP BY blog.id;";
}

if (isset($_GET['search'])){
    $search = $_GET['search'];
    $sql = "SELECT blog.*, COUNT(comment.star) AS star_quantity, SUM(comment.star) AS star_total
    FROM blog
    LEFT JOIN comment ON blog.id = comment.blog_id
    WHERE blog.title LIKE '%$search%'
    GROUP BY blog.id;
    ";
}

if (isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM blog WHERE `id` = '$id'";
}

if (isset($_GET['popular'])){
    $sql = "SELECT blog.*, AVG(star) AS star_avg
    FROM blog 
    LEFT JOIN comment ON blog.id = comment.blog_id
    GROUP BY blog.id
    HAVING star_avg IS NOT NULL
    ORDER BY star_avg DESC";
}

if (isset($_GET['recent'])){
    $sql = "SELECT * FROM blog ORDER BY id DESC";
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