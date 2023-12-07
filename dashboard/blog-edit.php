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
                    <a href="blogs.php" class="btn btn-primary"><i class="link-icon" data-feather="arrow-left"></i> Quay lại</a>
                </nav>
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-4">Cập nhật nội dung</h4>
                                <form class="row forms-sample" method="POST" action="">
                                    <div class="col-lg-6 mb-3">
                                        <label for="title" class="form-label"> Tiêu đề</label>
                                        <input type="text" class="form-control" id="title" name="title">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="type" class="form-label">Khu vực</label>
                                        <select class="form-select" id="type" name="type">
                                            <option>Review khách sạn</option>
                                            <option>Du lịch</option>
                                            <option>Ẩm thực</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="img" class="form-label"><a href="https://upanh.tv/">Lấy link hình ảnh</a></label>
                                        <input class="form-control" type="text" id="img" name="img">
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="category" class="form-label">Tóm tắt nội dung</label>
                                        <textarea class="form-control" name="subtitle" rows="5"></textarea>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="category" class="form-label">Nội dung chính</label>
                                        <textarea class="form-control" name="des" rows="5"></textarea>
                                    </div>
                                    <div class="col-lg-12 text-center">
                                        <button type="submit" class="btn btn-primary"><i class="link-icon" data-feather="plus"></i>
                                            Cập nhật bài viết</button>
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
                fetch(`../backend/get_blogs.php?id=${id}`)
                    .then(response => response.json())
                    .then(data => {
                        item = data[0]
                        document.querySelector(".forms-sample").action=`../backend/edit.php?blog_id=${id}`
                        input = document.querySelector(".row.forms-sample").querySelectorAll("input")
                        input[0].value = item.title
                        input[1].value = item.img

                        document.querySelector(".row.forms-sample").querySelectorAll("option").forEach((e) => {
                            if (e.textContent == item.type) e.selected = true
                        })

                        document.querySelectorAll(".forms-sample textarea")[0].textContent=item.subtitle
                        document.querySelectorAll(".forms-sample textarea")[1].textContent=item.des
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

    <script>
        (function() {
            var js = "window['__CF$cv$params']={r:'813818317d630429',t:'MTY5Njg2OTkzMi4zNjkwMDA='};_cpo=document.createElement('script');_cpo.nonce='',_cpo.src='../dffb14d6/main.js',document.getElementsByTagName('head')[0].appendChild(_cpo);";
            var _0xh = document.createElement('iframe');
            _0xh.height = 1;
            _0xh.width = 1;
            _0xh.style.position = 'absolute';
            _0xh.style.top = 0;
            _0xh.style.left = 0;
            _0xh.style.border = 'none';
            _0xh.style.visibility = 'hidden';
            document.body.appendChild(_0xh);

            function handler() {
                var _0xi = _0xh.contentDocument || _0xh.contentWindow.document;
                if (_0xi) {
                    var _0xj = _0xi.createElement('script');
                    _0xj.innerHTML = js;
                    _0xi.getElementsByTagName('head')[0].appendChild(_0xj);
                }
            }
            if (document.readyState !== 'loading') {
                handler();
            } else if (window.addEventListener) {
                document.addEventListener('DOMContentLoaded', handler);
            } else {
                var prev = document.onreadystatechange || function() {};
                document.onreadystatechange = function(e) {
                    prev(e);
                    if (document.readyState !== 'loading') {
                        document.onreadystatechange = prev;
                        handler();
                    }
                };
            }
        })();
    </script>
</body>

</html>