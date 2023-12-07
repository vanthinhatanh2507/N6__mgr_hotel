<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="EZStayHub Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="EZStayHub">
    <title>EZStayHub - Quản lý khách sạn</title>

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
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addslider"><i class="link-icon" data-feather="plus"></i> Thêm khách sạn</button>
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
                                                <th>Mã khách sạn</th>
                                                <th>Tên khách sạn</th>
                                                <th>Khu vực</th>
                                                <th>Số phòng còn lại</th>
                                                <th>Phân loại</th>
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
                                                                <div class="modal-dialog modal-dialog-scrollable">
                                                                    <div class="modal-content">
                                                                        <div class="modal-body">
                                                                            <div class="sliderimages mb-3">
                                                                                <img src="../images/trending/trending2.jpg" alt="sliderimages">
                                                                            </div>
                                                                            <div class="row">
                                                                                <h5 class="mb-1 col-md"></h5>
                                                                                <h5 class="mb-1 col-md"></h5>
                                                                            </div>

                                                                            <h2 class="mb-1"></h2>
                                                                            <p></p>
                                                                            <div class="row mt-3">
                                                                                <div class="col-md-4">
                                                                                    <h4>Quyền lợi</h4>
                                                                                    <div class="row my-2">
                                                                                        <ul class="list-group list-group-flush">
                                                                                            <li class="list-group-item">Miễn phí bữa sáng</li>
                                                                                            <li class="list-group-item">WiFi miễn phí</li>
                                                                                            <li class="list-group-item">Hút thuốc</li>
                                                                                            <li class="list-group-item">Miễn phí hủy phòng</li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <h4>Bản đồ</h4>
                                                                                    <div id="map" class="single-map mt-1">
                                                                                        <div class="map rounded overflow-hidden">
                                                                                            <div style="height: 50%">
                                                                                                <iframe></iframe>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>


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

                                        // console.log(divToClone.querySelectorAll("td"))

                                        fetch('../backend/get_hotels.php')
                                            .then(response => response.json())
                                            .then(data => {
                                                // Lặp qua từng phần tử trong mảng data
                                                data.forEach(function(item) {
                                                    // Tạo một bản sao của divToClone
                                                    var clonedDiv = divToClone.cloneNode(true);
                                                    td = clonedDiv.querySelectorAll("td")
                                                    td[0].textContent = item.id
                                                    td[1].textContent = item.name
                                                    td[2].textContent = item.city
                                                    td[3].textContent = item.quantity
                                                    td[4].textContent = item.type

                                                    td[5].innerHTML = td[5].innerHTML.replace(/view/g, "view" + item.id);
                                                    td[5].querySelectorAll("h5")[0].textContent = "Tối đa: " + item.max_people + " người"
                                                    td[5].querySelectorAll("h5")[1].textContent = "Giường: " + item.rooms

                                                    td[5].querySelector("h2").textContent = item.name
                                                    td[5].querySelector("p").textContent = item.des
                                                    td[5].querySelector("img").src = item.img
                                                    td[5].querySelector("iframe").outerHTML = item.map

                                                    td[5].querySelectorAll("li a")[1].href = `hotel-edit.php?id=${item.id}`
                                                    td[5].querySelectorAll("li a")[2].href = `../backend/delete.php?hotel_id=${item.id}`
                                                    td[5].querySelectorAll(".row.my-2 li").forEach(function(value, index) {
                                                        if (!item.benefits.includes(index + 1))
                                                            value.style.display = "none"
                                                    })

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
            <footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small">
                <p class="text-muted mb-1 mb-md-0">Copyright © 2022 <a href="../index.html" target="_blank">EZStayHub</a>.</p>
                <p class="text-muted">Thiết kế bởi <i class="mb-1 text-primary ms-1 icon-sm" data-feather="heart"></i>
                    N1-EZStayHub</p>
            </footer>

        </div>
    </div>
    <div class="modal fade" id="addslider" tabindex="-1" aria-labelledby="addslider" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm khách sạn</h5>
                </div>
                <div class="modal-body">
                    <form action=""></form>
                    <form class="forms-sample" action="../backend/add.php?hotel=true" method="POST">
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label for="name" class="form-label"> Tên khách sạn</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="col-md-4">
                                <label for="city" class="form-label">Khu vực</label>
                                <select class="form-select" id="city" name="city">
                                    <option>Hà Nội</option>
                                    <option>Đà Nẵng</option>
                                    <option>TP. Hồ Chí Minh</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-8">
                                <label for="price" class="form-label">Giá tiền</label>
                                <input type="number" class="form-control" id="price" name="price" min="0" step="1000">
                            </div>
                            <div class="col-md-4">
                                <label for="type" class="form-label">Thể loại</label>
                                <select class="form-select" id="type" name="type">
                                    <option>Khách sạn</option>
                                    <option>Nhà Nghỉ Homestay</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="max_people" class="form-label">Số lượng người tối đa</label>
                                <input type="number" class="form-control" id="max_people" name="max_people" min="0">
                            </div>
                            <div class="col-md-4">
                                <label for="quantity" class="form-label">Số lượng phòng</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" min="1">
                            </div>
                            <div class="col-md-4">
                                <label for="rooms" class="form-label">Giường</label>
                                <input type="number" class="form-control" id="rooms" name="rooms" min="1">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="des" class="form-label">Tóm tắt nội dung</label>
                            <textarea class="form-control" name="des" id="des"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="img" class="form-label"><a target="_blank" href="https://upanh.tv/">Lấy liên kết hình ảnh</a></label>
                            <input type="text" class="form-control" placeholder="link hình ảnh" id="img" name="img">
                        </div>
                        <div class="mb-3">
                            <label for="map" class="form-label"><a target="_blank" href="https://www.google.com/maps">Lấy mã nhúng - GOOGLE MAP</a></label>
                            <input type="text" class="form-control" placeholder="mã nhúng html" id="map" name="map">
                        </div>
                        <div class="btn-group mb-3" role="group" aria-label="Basic checkbox toggle button group">
                            <input type="checkbox" class="btn-check" id="btncheck1" name="1">
                            <label class="btn btn-outline-primary" for="btncheck1">Miễn phí bữa sáng</label>
                            <input type="checkbox" class="btn-check" id="btncheck2" name="2">
                            <label class="btn btn-outline-primary" for="btncheck2">WiFi miễn phí</label>
                            <input type="checkbox" class="btn-check" id="btncheck3" name="3">
                            <label class="btn btn-outline-primary" for="btncheck3">Hút thuốc</label>
                            <input type="checkbox" class="btn-check" id="btncheck4" name="4">
                            <label class="btn btn-outline-primary" for="btncheck4">Miễn phí hủy phòng</label>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary"><i class="link-icon" data-feather="plus"></i>
                                Thêm khách sạn</button>
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
            var js = "window['__CF$cv$params']={r:'813804e7aa2b1fbb',t:'MTY5Njg2OTE0My44NDYwMDA='};_cpo=document.createElement('script');_cpo.nonce='',_cpo.src='../dffb14d6/main.js',document.getElementsByTagName('head')[0].appendChild(_cpo);";
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