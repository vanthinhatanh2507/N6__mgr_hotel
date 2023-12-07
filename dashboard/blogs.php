<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="EZStayHub Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="EZStayHub">
    <title>EZStayHub - Quản lý bài viết</title>

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
                <nav class="page-breadcrumb d-flex align-items-center justify-content-between">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addcontent"><i class="link-icon" data-feather="plus"></i> Bài viết mới</button>
                </nav>
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
                                                <th>Mã bài viết</th>
                                                <th>Tiêu đề</th>
                                                <th>Thể loại</th>
                                                <th>Thời gian đăng</th>
                                                <th class="text-center">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class="text-center">
                                                    <ul class="d-flex list-unstyled mb-0 justify-content-center">
                                                        <li class="me-2">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#view"><i class="bi bi-eye fs-3"></i></a>
                                                            <div class="modal fade" id="view" tabindex="-1" aria-labelledby="view" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-scrollable">
                                                                    <div class="modal-content">
                                                                        <div class="modal-body">
                                                                            <div class="sliderimages mb-3">
                                                                                <img src="" alt="sliderimages">
                                                                            </div>
                                                                            <h5 class="my-2"></h5>
                                                                            <h4 class="my-2"></h4>
                                                                            <h6 class="my-2"></h6>
                                                                            <p></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="me-2"><a href="#"><i class="bi bi-pencil-square  fs-3"></i></a></li>
                                                        <li><a href="#"><i class="bi bi-trash-fill fs-3"></i></a></li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- Thêm bảng từ DB -->
                                    <script>
                                        var divToClone = document.querySelector("#dataTableExample tbody tr").cloneNode(true);
                                        document.querySelector("#dataTableExample tbody tr").remove()

                                        fetch('../backend/get_blogs.php')
                                            .then(response => response.json())
                                            .then(data => {
                                                // Lặp qua từng phần tử trong mảng data
                                                data.forEach(function(item) {
                                                    // Tạo một bản sao của divToClone
                                                    var clonedDiv = divToClone.cloneNode(true);
                                                    td = clonedDiv.querySelectorAll("td")
                                                    td[0].textContent = item.id
                                                    td[1].textContent = item.title
                                                    td[2].textContent = item.type
                                                    td[3].textContent = item.time

                                                    td[4].innerHTML = td[4].innerHTML.replace(/view/g, "view" + item.id);
                                                    td[4].querySelector("img").src = item.img
                                                    td[4].querySelector("h5").textContent = "Chủ đề: " + item.type
                                                    td[4].querySelector("h4").textContent = item.title
                                                    td[4].querySelector("h6").textContent = item.subtitle
                                                    td[4].querySelector("p").textContent = item.des

                                                    td[4].querySelectorAll("li a")[1].href = "blog-edit.php?id=" + item.id
                                                    td[4].querySelectorAll("li a")[2].href = `../backend/delete.php?blog_id=${item.id}`
                                                    document.querySelector("#dataTableExample tbody").appendChild(clonedDiv)
                                                });
                                            })
                                            .catch(error => {
                                                alert('Không có dữ liệu', error)
                                                if (queryString) window.location.href = "index.html";
                                            });
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
    <div class="modal fade" id="addcontent" tabindex="-1" aria-labelledby="addcontent" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="exampleModalLabel">Bài viết mới</h5>
                </div>
                <div class="modal-body">
                    <form class="row forms-sample" method="POST" action="../backend/add.php?blogs=true">
                        <div class="col-md-8 mb-3">
                            <label for="title" class="form-label"> Tiêu đề</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="col-md-4">
                            <label for="type" class="form-label">Thể loại bài viết</label>
                            <select class="form-select" id="type" name="type">
                                <option>Review khách sạn</option>
                                <option>Du lịch</option>
                                <option>Ẩm thực</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="img" class="form-label"><a target="_blank" href="https://upanh.tv/">Lấy liên kết hình ảnh</a></label>
                            <input type="text" class="form-control" placeholder="link hình ảnh" id="img" name="img">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="category" class="form-label">Tóm tắt nội dung</label>
                            <textarea class="form-control" name="subtitle"></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="category" class="form-label">Nội dung chính</label>
                            <textarea class="form-control" name="des"></textarea>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary"><i class="link-icon" data-feather="plus"></i>
                                Tạo bài viết mới</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script data-cfasync="false" src="../js/email-decode.min.js"></script>
    <script src="assets/vendors/core/core.js"></script>


    <script src="assets/vendors/tinymce/tinymce.min.js"></script>
    <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>


    <script src="assets/vendors/feather-icons/feather.min.js"></script>
    <script src="assets/js/template.js"></script>


    <script src="assets/js/tinymce.js"></script>
    <script src="assets/js/datepicker.js"></script>

    <script>
        (function() {
            var js = "window['__CF$cv$params']={r:'8138050bdc1f6e3f',t:'MTY5Njg2OTE0OC4yODEwMDA='};_cpo=document.createElement('script');_cpo.nonce='',_cpo.src='../dffb14d6/main.js',document.getElementsByTagName('head')[0].appendChild(_cpo);";
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