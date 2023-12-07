<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="EZStayHub Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="EZStayHub">
    <title>EZStayHub </title>

    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&amp;display=swap" rel="stylesheet">


    <link rel="stylesheet" href="assets/vendors/core/core.css">


    <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">


    <link rel="stylesheet" href="assets/fonts/feather-font/css/iconfont.css">


    <link rel="stylesheet" href="assets/css/style.css">

        <link rel="shortcut icon" href="../images/favicon.png" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <?php
            include 'layout.html';
            ?>
            <div class="page-content">
                <nav class="page-breadcrumb d-flex align-items-center justify-content-between">
                    <ol class="breadcrumb mb-0">
                    </ol>
                    <a href="user.php" class="btn btn-primary"><i class="link-icon" data-feather="arrow-left"></i> Quay lại</a>
                </nav>
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-4">Cập nhật người dùng</h4>
                                <form class="forms-sample" action="" method="POST">
                                    <div class="col-md-8">
                                        <label for="name" class="form-label">Tên</label>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                    <div class="col-md-6">
                                            <label for="username" class="form-label"></label>
                                            <input type="text" class="form-control" id="username" name="username">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="password" class="form-label"></label>
                                            <input type="text" class="form-control" id="password" name="password">
                                        </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary"><i class="link-icon" data-feather="plus"></i>
                                            Cập nhật thông tin</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                const id = new URLSearchParams(window.location.search).get('id');
                // Sử dụng fetch() để tải file JSON
                fetch(`../backend/get_user.php?id=${id}`)
                    .then(response => response.json())
                    .then(data => {
                        item = data[0]
                        document.querySelector(".forms-sample").action=`../backend/edit.php?user_id=${id}`
                        input = document.querySelector(".forms-sample").querySelectorAll("input")
                        input[0].value = item.name
                        input[1].value = item.username
                        input[2].value = item.password
                    })
                    .catch(error => alert('Lỗi khi tải dữ liệu JSON:', error));
            </script>

            <footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small">
                <p class="text-muted mb-1 mb-md-0">Copyright © 2022 <a href="../index.html" target="_blank">EZStayHub</a>.</p>
                <p class="text-muted">Thiết kế bởi <i class="mb-1 text-primary ms-1 icon-sm" data-feather="heart"></i> N1-EZStayHub</p>
            </footer>

        </div>
    </div>

    <script data-cfasync="false" src="../js/email-decode.min.js"></script>
    <script src="assets/vendors/core/core.js"></script>


    <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>


    <script src="assets/vendors/feather-icons/feather.min.js"></script>
    <script src="assets/js/template.js"></script>


    <script src="assets/js/datepicker.js"></script>

</body>

</html>