<!DOCTYPE html>
<html>

<!-- hotel.php  16:45:20 GMT -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="EZStayHub Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="EZStayHub">
    <title>EZStayHub - Khách sạn</title>

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
                <form class="forms-sample" action="" method="POST">
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
                        <label for="map" class="form-label"><a target="_blank" href="https://www.google.com/maps">Lấy mã nhúng</a></label>
                        <input type="text" class="form-control" id="map" name="map">
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
                            Cập nhật thông tin</button>
                    </div>
                </form>
            </div>
            <script>
                const id = new URLSearchParams(window.location.search).get('id');
                
                // Sử dụng fetch() để tải file JSON
                fetch(`../backend/get_hotels.php?id=${id}`)
                    .then(response => response.json())
                    .then(data => {
                        item = data[0]
                        
                        document.querySelector(".forms-sample").action=`../backend/edit.php?hotel_id=${id}`
                        input = document.querySelector(".forms-sample").querySelectorAll("input")
                        input[0].value = item.name
                        input[1].value = item.price
                        input[2].value = item.max_people
                        input[3].value = item.quantity
                        input[4].value = item.rooms
                        input[5].value = item.img
                        input[6].value = item.map

                        select = document.querySelector(".forms-sample").querySelectorAll("select")
                        select[0].querySelectorAll("option").forEach((e) => {
                            if (e.textContent == item.city) e.selected = true
                        })
                        select[1].querySelectorAll("option").forEach((e) => {
                            if (e.textContent == item.type) e.selected = true
                        })

                        document.querySelector(".forms-sample textarea").textContent = item.des
                        document.querySelector(".btn-group.mb-3").querySelectorAll("input").forEach((value, index) => {
                            if (item.benefits.includes(index + 1))
                                value.checked = true
                        })
                    })
                    .catch(error => alert('Lỗi khi tải dữ liệu JSON:', error));
            </script>

            <footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small">
                <p class="text-muted mb-1 mb-md-0">Copyright © 2022 <a href="../index.html" target="_blank">EZStayHub</a>.</p>
                <p class="text-muted">Thiết kế bởi <i class="mb-1 text-primary ms-1 icon-sm" data-feather="heart"></i>
                    N1-EZStayHub</p>
            </footer>

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