<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="EZStayHub Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="EZStayHub">
    <title>EZStayHub - Danh sách đặt phòng</title>

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
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="dataTableExample" class="table">
                                        <thead>
                                            <tr>
                                                <th>Mã đơn</th>
                                                <th>Khách sạn</th>
                                                <th>Tên người đặt</th>
                                                <th>Số điện thoại</th>
                                                <th>Thời gian đặt</th>
                                                <th>Giá</th>
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
                                                <td></td>
                                                <td class="text-center">
                                                    <ul class="d-flex list-unstyled mb-0 justify-content-center">
                                                        <li class="me-2">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#view"><i class="bi bi-eye fs-3"></i></a>
                                                            <div class="modal fade" id="view" tabindex="-1" aria-labelledby="view" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-scrollable">
                                                                    <div class="modal-content">
                                                                        <div class="modal-body">
                                                                            <div class="card">
                                                                            <img src="" class="card-img-top w-100" alt="Hotel Img">
                                                                                <div class="card-body">
                                                                                    <h3 class="card-title">Người đặt: <strong></strong></h3>
                                                                                    <p class="card-text">Đặt phòng khách sạn: <a href=""></a></p>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col">
                                                                                        <h5>Thông tin cá nhân</h5>
                                                                                        <ul class="list-group list-group-flush personal-info">
                                                                                            <li class="list-group-item">Giới tính: </li>
                                                                                            <li class="list-group-item">Email: </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <h5>Thông tin phòng</h5>
                                                                                        <ul class="list-group list-group-flush room-info">
                                                                                            <li class="list-group-item">Số lượng phòng đặt: </li>
                                                                                            <li class="list-group-item">Số lượng người: </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="card-body checkin-out">
                                                                                    <a class="card-link">Ngày nhập phòng: </a>
                                                                                    <a class="card-link">Ngày trả phòng: </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li><a href="123" class="delete"><i class="bi bi-trash-fill fs-3"></i></a></li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <script>
                                        var table = document.querySelector("#dataTableExample tbody")
                                        var divToClone = document.querySelector("#dataTableExample tbody tr").cloneNode(true);
                                        document.querySelector("#dataTableExample tbody tr").remove()
                                        
                                        fetch('../backend/get_booking.php')
                                            .then(response => response.json())
                                            .then(data => {
                                                // Lặp qua từng phần tử trong mảng data
                                                data.forEach(function(item) {
                                                    // Tạo một bản sao của divToClone
                                                    var clonedDiv = divToClone.cloneNode(true);
                                                    td = clonedDiv.querySelectorAll("td")
                                                    td[0].textContent = item.id
                                                    td[1].textContent = item.hotel_name
                                                    td[2].textContent = item.name
                                                    td[3].textContent = item.phone
                                                    time = item.time.split(" ")[0]
                                                    td[4].textContent = `${time.split("-")[2]} Th ${time.split("-")[1]}, ${time.split("-")[0]} lúc ${item.time.split(" ")[1]}`
                                                    td[6].querySelector(".delete").href = `../backend/delete.php?booking_id=${item.id}`
                                                    
                                                    // Tính toán chi phí
                                                    var checkin = item.checkin.split("-");
                                                    var checkout = item.checkout.split("-");

                                                    var ngay1 = new Date(checkin[0], checkin[1] - 1, checkin[2]);
                                                    var ngay2 = new Date(checkout[0], checkout[1] - 1, checkout[2]);
                                                    var soNgay = (ngay2.getTime() - ngay1.getTime()) / (1000 * 60 * 60 * 24);

                                                    if (item.max_people * item.rooms >= item.people) {
                                                        td[5].textContent = (item.price * (soNgay + 1)).toLocaleString() + " VNĐ"
                                                    } else {
                                                        td[5].textContent = (item.price * (soNgay + 1) + (100000 * (item.people - item.max_people * item.rooms) * (soNgay + 1))).toLocaleString() + " VNĐ"
                                                    }

                                                    td[6].innerHTML = td[6].innerHTML.replace(/view/g, "view" + item.id);
                                                
                                                    td[6].querySelector("img").src = item.img
                                                    td[6].querySelector("strong").textContent = item.name
                                                    td[6].querySelector("p a").textContent = item.hotel_name
                                                    td[6].querySelector("p a").href = `../hotel-info.html?id=${item.hotel_id}`
                                                    td[6].querySelectorAll(".personal-info li")[0].textContent = "Giới tính: "+item.gender
                                                    td[6].querySelectorAll(".personal-info li")[1].textContent = "Email: "+item.email
                                                    td[6].querySelectorAll(".room-info li")[0].textContent = "Số lượng phòng đặt: "+item.rooms
                                                    td[6].querySelectorAll(".room-info li")[1].textContent = "Số lượng người: "+item.people
                                                    td[6].querySelectorAll(".checkin-out a")[0].textContent = "Ngày nhập phòng: "+item.checkin
                                                    td[6].querySelectorAll(".checkin-out a")[1].textContent = "Ngày trả phòng: "+item.checkout

                                                    table.appendChild(clonedDiv)
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

    <script data-cfasync="false" src="../js/email-decode.min.js"></script>
    <script src="assets/vendors/core/core.js"></script>


    <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>


    <script src="assets/vendors/feather-icons/feather.min.js"></script>
    <script src="assets/js/template.js"></script>


    <script src="assets/js/datepicker.js"></script>

</body>

</html>