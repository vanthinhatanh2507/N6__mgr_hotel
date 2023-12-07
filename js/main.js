/*------------------------------------------------------------------
* Project:        EZStayHub 
* Author:         bizberg_themes
* URL:            https://themeforest.net/user/bizberg_themes
* Created:        06/27/2022
-------------------------------------------------------------------
*/

(function ($) {
    "use strict";


    /*======== Doucument Ready Function =========*/
    jQuery(document).ready(function () {
        //CACHE JQUERY OBJECTS
        $("#status").fadeOut();
        $("#preloader").delay(200).fadeOut("slow");
        $("body").delay(200).css({ "overflow": "visible" });


        /* Init Wow Js */
        new WOW().init();

    });

    //search categories
    $('a[href="#search1"]').on('click', function (event) {
        event.preventDefault();
        $('#search1').addClass('open');
        $('#search1 > form > input[type="search"]').focus();
    });
    $('#search1, #search1 button.close').on('click keyup', function (event) {
        if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
            $(this).removeClass('open');
        }
    });

    jQuery(document).ready(() => {
        jQuery('.js-video-button').modalVideo({
            channel: 'vimeo'
        });
    });

    $(".range-slider-ui").each(function () {
        var minRangeValue = parseInt($(this).attr('data-min'));
        var maxRangeValue = parseInt($(this).attr('data-max'));
        var minName = $(this).attr('data-min-name');
        var maxName = $(this).attr('data-max-name');
        var unit = $(this).attr('data-unit');
        
        $(this).slider({
            range: true,
            min: minRangeValue,
            max: maxRangeValue,
            values: [minRangeValue, maxRangeValue],
            slide: function (event, ui) {
                event = event;
                var currentMin = parseInt(ui.values[0]);
                var currentMax = parseInt(ui.values[1]);
    
                // Sử dụng toLocaleString để định dạng giá trị
                var formattedMin = currentMin.toLocaleString();
                var formattedMax = currentMax.toLocaleString();
    
                $(this).children(".min-value").text(formattedMin + " " + unit);
                $(this).children(".max-value").text(formattedMax + " " + unit);
                $(this).children(".current-min").val(currentMin);
                $(this).children(".current-max").val(currentMax);
    
                // Gọi hàm xử lý sau khi phần trượt thay đổi giá trị
                handleSliderChange(currentMin, currentMax);
            }
        }); 
    });
    


    /* ------------------------------------------------------------------------ */
    /* BACK TO TOP
   /* ------------------------------------------------------------------------ */
    $(document).on('click', '#back-to-top, .back-to-top', () => {
        $('html, body').animate({
            scrollTop: 0
        }, '500');
        return false;
    });
    $(window).on('scroll', () => {
        if ($(window).scrollTop() > 500) {
            $('#back-to-top').fadeIn(200);
        } else {
            $('#back-to-top').fadeOut(200);
        }
    });

    // Slick SLider
    $('.slider-store').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        direction: 'vertical',
        arrows: false,
        dots: false,
        fade: true,
        autoplay: true,
        asNavFor: '.slider-thumbs'
    });


    $('.slider-thumbs').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        asNavFor: '.slider-store',
        dots: false,
        arrows: false,
        autoplay: true,
        direction: 'vertical',
        centerMode: true,
        focusOnSelect: true,
        responsive: [{
            breakpoint: 800,
            settings: {
                arrows: false,
            }
        }]

    });


    $('.review-slider').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        rows: 0,
        autoplay: true,
        speed: 2000,
        loop: true,
        responsive: [{
            breakpoint: 991,
            settings: {
                slidesToShow: 1,
                arrows: false,
            }
        }]
    });

    $('.review-slider1').slick({
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        rows: 0,
        autoplay: true,
        speed: 5000,
        loop: true,
        responsive: [{
            breakpoint: 1100,
            settings: {
                slidesToShow: 1
            }
        }]
    });

    $('.about-slider').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        autoplay: true,
        rows: 0,
        speed: 4000,
        loop: true,
        responsive: [{
            breakpoint: 700,
            settings: {
                arrows: false
            }
        }]
    });

    $('.side-slider').slick({
        infinite: true,
        slidesToShow: 6,
        slidesToScroll: 1,
        arrows: false,
        rows: 0,
        dots: false,
        autoplay: true,
        speed: 4000,
        loop: true,
        responsive: [{
            breakpoint: 1000,
            settings: {
                slidesToShow: 3
            }
        },
        {
            breakpoint: 811,
            settings: {
                slidesToShow: 2
            }
        },
        {
            breakpoint: 500,
            settings: {
                slidesToShow: 1
            }
        }]
    });

    $('.attract-slider').slick({
        infinite: true,
        slidesToShow: 8,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        speed: 2000,
        rows: 0,
        autoplay: true,
        draggable: false,
        responsive: [{
            breakpoint: 1000,
            settings: {
                slidesToShow: 4
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 3
            }
        },
        {
            breakpoint: 500,
            settings: {
                slidesToShow: 2
            }
        }]
    });


    $('.team-slider').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: false,
        dots: true,
        autoplay: true,
        speed: 1000,
        rows: 0,
        loop: true,
        responsive: [{
            breakpoint: 1000,
            settings: {
                slidesToShow: 2
            }
        }, {
            breakpoint: 750,
            settings: {
                slidesToShow: 1
            }
        }]
    });

    $('.item-slider').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        autoplay: true,
        speed: 2000,
        rows: 0,
        loop: true,
        responsive: [{
            breakpoint: 1000,
            settings: {
                slidesToShow: 2,
                arrows: false,
            }
        }, {
            breakpoint: 750,
            settings: {
                slidesToShow: 1,
                arrows: false,
            }
        }]
    });

    $('.item-slider1').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        autoplay: true,
        speed: 2000,
        rows: 0,
        loop: true,
        responsive: [{
            breakpoint: 1000,
            settings: {
                slidesToShow: 1,
                arrows: false,
            }
        }, {
            breakpoint: 750,
            settings: {
                slidesToShow: 1,
                arrows: false,
            }
        }]
    });

    $('.banner-slider').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        autoplay: true,
        speed: 2000,
        rows: 0,
        cursor: false,
        loop: true,
        responsive: [{
            breakpoint: 1000,
            settings: {
                slidesToShow: 2
            }
        }, {
            breakpoint: 800,
            settings: {
                slidesToShow: 1
            }
        }]
    });

    $('.shop-slider').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        autoplay: true,
        speed: 2000,
        rows: 0,
        cursor: false,
        loop: true,
        responsive: [{
            breakpoint: 1000,
            settings: {
                slidesToShow: 2
            }
        }, {
            breakpoint: 800,
            settings: {
                slidesToShow: 1
            }
        }]
    });

    // Slick Testimonial Slider
    $('.sl-testimonial-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        vertical: true,
        verticalSwiping: true,
        autoplay: true,
        Speed: 8000,
        rows: 0,
        infinite: true,
        arrows: false,
        dots: false,
        adaptiveHeight: true
    });

    $('.partner-slider').slick({
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        autoplay: true,
        speed: 2000,
        rows: 0,
        loop: true,
        responsive: [{
            breakpoint: 1000,
            settings: {
                slidesToShow: 3
            }
        }, {
            breakpoint: 800,
            settings: {
                slidesToShow: 2
            }
        }, {
            breakpoint: 500,
            settings: {
                slidesToShow: 1
            }
        }]
    });


    $("#contactform2").validate({
        submitHandler: function () {

            $.ajax({
                url: 'mail/contact.php',
                type: 'POST',
                data: {
                    fname: $('input[name="first_name"]').val(),
                    lname: $('input[name="last_name"]').val(),
                    email: $('input[name="email"]').val(),
                    phone: $('input[name="phone"]').val(),
                    comments: $('textarea[name="comments"]').val(),
                },
                success: function (result) {
                    $('#contactform-error-msg').html(result);
                    $("#contactform2")[0].reset();
                }
            });

        }
    });


    /*-----------------------------------------------------------------------------------*/
    /*  COUNTDOWN
    /*-----------------------------------------------------------------------------------*/

    $(document).ready(() => {
        loopcounter('coming-counter');
    });

    /*-----------------------------------------------------------------------------------*/
    /*  COUNTER UP
    /*-----------------------------------------------------------------------------------*/
    $('.value').counterUp({
        delay: 50,
        time: 1000
    });
    /*-----------------------------------------------------------------------------------*/
    /*  MASONRY
    /*-----------------------------------------------------------------------------------*/

    $('.blog-main').masonry({
        // options
        itemSelector: '.mansonry-item',
    });

    $('.trend-box1').masonry({
        // options
        itemSelector: '.mansonry-item1',
    });

    // Nice Select JS
    $('.niceSelect').niceSelect();

    $('a[href="#search1"]').on('click', function (event) {
        event.preventDefault();
        $('#search1').addClass('open');
        $('#search1 > form > input[type="search"]').focus();
    });
    $('#search1, #search1 button.close').on('click keyup', function (event) {
        if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
            $(this).removeClass('open');
        }
    });
    //Do not include! This prevents the form from submitting for DEMO purposes only!
    $('form').submit(function (event) {
        event.preventDefault();
        return false;
    });

})(jQuery);


jQuery(window).on('resize load', () => {
    resize_eb_slider();
}).resize();
/**
 * Resize slider
 */
function resize_eb_slider() {
    let bodyheight = jQuery(this).height();
    if (jQuery(window).width() > 1400) {
        bodyheight *= 0.90;
        jQuery('.slider').css('height', `${bodyheight}px`);
    }
}


function hienThiThoiGian() {
    var thoiGianHienTai = new Date();
    var ngay = thoiGianHienTai.toLocaleDateString().split("/");
    var gio = thoiGianHienTai.getHours();
    var phut = thoiGianHienTai.getMinutes();
    var giay = thoiGianHienTai.getSeconds();
    document.querySelector("a.date_now").innerHTML = `<i class="icon-calendar white"></i> ${ngay[0]} Th${ngay[1]}, ${ngay[2]}`
    document.querySelector("a.time_now").innerHTML = `<i class="icon-clock white"></i> ${gio}:${phut}:${giay}</a>`
}

async function signUp() {
    const check = document.querySelector("#floatingInputInvalid input");
    if (check.value !== "") {
        document.querySelector("#floatingInputInvalid label").textContent = "";
        check.classList.remove("is-invalid");
        check.classList.add("is-valid");
        document.querySelector("#signup").disabled = false
        document.querySelector("#signup").classList.remove("btn-secondary")
    } else {
        check.classList.remove("is-valid");
        check.classList.add("is-invalid");
        document.querySelector("#floatingInputInvalid label").textContent = "Vui lòng nhập nội dung";
        document.querySelector("#signup").disabled = true
        document.querySelector("#signup").classList.add("btn-secondary")
        return;
    }

    try {
        const response = await fetch('backend/get_user.php');
        if (response.ok) {
            const data = await response.json();
            if (data.some(item => item.username === check.value)) {
                check.classList.remove("is-valid");
                check.classList.add("is-invalid");
                document.querySelector("#floatingInputInvalid label").textContent = "Tên đăng nhập đã tồn tại";
                document.querySelector("#signup").disabled = true
                document.querySelector("#signup").classList.add("btn-secondary")
            } else {
                check.classList.remove("is-invalid");
                check.classList.add("is-valid");
                document.querySelector("#signup").disabled = false
                document.querySelector("#signup").classList.remove("btn-secondary")
            }
        } else {
            throw new Error('Lỗi khi lấy dữ liệu từ máy chủ');
        }
    } catch (error) {
        alert('Lỗi:', error);
    }
}

// Gọi hàm hiển thị thời gian một lần để hiển thị ngay khi trang được tải lên

// Sử dụng setInterval để cập nhật thời gian từng giây
setInterval(hienThiThoiGian, 1000); // 1000 ms = 1 giây
// Hàm lấy giá trị của cookie
function getCookie(name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length === 2) return parts.pop().split(";").shift();
}

document.addEventListener("DOMContentLoaded", function () {
    hienThiThoiGian();
    if (getCookie("name")) {
        document.querySelector(".register-login.align-items-center").innerHTML = `<div><i class="icon-user"></i> ${decodeURIComponent(getCookie("name"))}</div> <hr> <a href="backend/diecookie.php">Đăng xuất</a>`
    } else {
        var urlParams = new URLSearchParams(window.location.search);
        var error = urlParams.get('error');
        if (error === "true") {
            alert("Sai tài khoản mật khẩu!");
        }
    }
});



