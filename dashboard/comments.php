<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="EZStayHub Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="EZStayHub">
    <title>EZStayHub - Quản lý bình luận</title>

    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&amp;display=swap" rel="stylesheet">


    <link rel="stylesheet" href="assets/vendors/core/core.css">


    <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">


    <link rel="stylesheet" href="assets/fonts/feather-font/css/iconfont.css">


    <link rel="stylesheet" href="assets/css/style.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <?php
            include 'layout.html';
            ?>
            <div class="page-content">
                <div class="search-box p-4 bg-white rounded mb-3 box-shadow">
                    <form class="forms-sample">
                        <div class="row align-items-center">
                            <div class="col-lg-4">
                                <h5>Tìm kiếm đa năng</h5>
                            </div>
                            <div class="col-lg-7 col-md-8">
                                <input type="text" id="searchInput" placeholder="Tìm kiếm nội dung bất kỳ trong bảng" class="form-control col-md 4">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="dataTableExample" class="table">
                                        <thead>
                                            <tr>
                                                <th>Mã bình luận</th>
                                                <th>Tên người bình luận</th>
                                                <th>Đánh giá(sao)</th>
                                                <th>Tiêu đề</th>
                                                <th>Thời gian</th>
                                                <th class="text-center">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class="text-center">
                                                    <ul class="d-flex list-unstyled mb-0 justify-content-center">
                                                        <li class="me-2">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#view"><i class="bi bi-eye fs-3"></i></a>
                                                            <div class="modal fade" id="view" tabindex="-1" aria-labelledby="view" aria-hidden="true">
                                                                <div class="modal-dialog ">
                                                                    <div class="modal-content">
                                                                        <div class="modal-body">
                                                                            <div class="sliderimages mb-3">
                                                                                <img src="../images/trending/trending2.jpg" alt="sliderimages">
                                                                            </div>
                                                                            <h4 class="mb-1 col-md"></h4>
                                                                            <div class="row my-3">
                                                                                <h5>Nội dung bình luận:</h5>
                                                                                <p>Tôi thấy cái này rất tuyệt và mọi thứ trên quá tuy</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li><a href="" class="delete"><i class="bi bi-trash-fill fs-3"></i></a></li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- Thêm bảng từ DB -->
                                    <script>
                                        var divToClone = document.querySelector("#dataTableExample tbody tr").cloneNode(true);
                                        document.querySelector("#dataTableExample tbody tr").remove()

                                        fetch('../backend/get_comment.php')
                                            .then(response => response.json())
                                            .then(data => {
                                                // Lặp qua từng phần tử trong mảng data
                                                data.forEach(function(item) {
                                                    // Tạo một bản sao của divToClone
                                                    var clonedDiv = divToClone.cloneNode(true);
                                                    td = clonedDiv.querySelectorAll("td")
                                                    td[0].textContent = item.comment_id
                                                    td[1].textContent = item.user_name
                                                    td[2].textContent = item.star
                                                    td[3].textContent = item.title
                                                    td[4].textContent = item.time

                                                    td[5].innerHTML = td[5].innerHTML.replace(/view/g, "view" + item.comment_id);
                                                    td[5].querySelector(".delete").href = `../backend/delete.php?comment_id=${item.comment_id}`
                                                    if (item.blog_title){
                                                        td[5].querySelector("h4").innerHTML = `Bài viết: <a href="../blog-info.html?id=${item.blog_id}">${item.blog_title}</a>`
                                                        td[5].querySelector("img").src = item.blog_img
                                                    }
                                                    else {
                                                        td[5].querySelector("h4").innerHTML = `Khách sạn: <a href="../hotel-info.html?id=${item.hotel_id}">${item.hotel_name}</a>`
                                                        td[5].querySelector("img").src = item.hotel_img
                                                    }
                                                    
                                                    td[5].querySelector("p").textContent = item.content
                                                    document.querySelector("#dataTableExample tbody").appendChild(clonedDiv)
                                                });
                                            })
                                            .catch(error => alert('Không có dữ liệu', error));
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Lấy tham chiếu đến ô tìm kiếm
        var searchInput = document.getElementById("searchInput");

        // Lấy tham chiếu đến bảng và các hàng dữ liệu
        var table = document.getElementById("dataTableExample");
        var rows = table.getElementsByTagName("tr");

        // Bắt sự kiện người dùng nhập vào ô tìm kiếm
        searchInput.addEventListener("input", function() {
            var searchText = searchInput.value.toLowerCase();

            // Duyệt qua các hàng dữ liệu và ẩn hoặc hiển thị dựa trên kết quả tìm kiếm
            for (var i = 1; i < rows.length; i++) { // Bắt đầu từ 1 để bỏ qua hàng tiêu đề
                var row = rows[i];
                var shouldShowRow = false;

                // Duyệt qua tất cả các ô của hàng và kiểm tra xem chúng có chứa chuỗi tìm kiếm không
                for (var j = 0; j < row.cells.length - 1; j++) {
                    var cell = row.cells[j];
                    var cellText = cell.textContent.toLowerCase();

                    if (cellText.includes(searchText)) {
                        shouldShowRow = true;
                        break;
                    }
                }

                if (shouldShowRow) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            }
        });
    </script>

    <script data-cfasync="false" src="../js/email-decode.min.js"></script>
    <script src="assets/vendors/core/core.js"></script>


    <script src="assets/vendors/tinymce/tinymce.min.js"></script>
    <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>


    <script src="assets/vendors/feather-icons/feather.min.js"></script>
    <script src="assets/js/template.js"></script>


    <script src="assets/js/tinymce.js"></script>
    <script src="assets/js/datepicker.js"></script>

</body>

</html>