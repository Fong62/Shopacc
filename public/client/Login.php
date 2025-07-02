<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'ĐĂNG NHẬP | '.$CMSNT->site('tenweb');
    require_once(__DIR__ . "/Header.php");
    require_once(__DIR__ . "/Nav.php");
?>

<!-- Giao diện Đăng nhập -->
<style>
    .note__title.login-header {
        color: #000000 !important;
        font-size: 26px;
        font-weight: 700;
        text-align: center;
        text-shadow: none !important;
    }

    .login-form label {
        color: #000000 !important;
    }

    .form-control {
        color: #000;
        background-color: #fff;
        border: 1px solid #ccc;
    }


    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .login-wrapper {
        display: flex;
        width: 100%;
        max-width: 1000px;
        background: rgba(255, 255, 255, 0.86);
        border-radius: 16px;
        box-shadow: 0 0 15px rgba(0,0,0,0.25);
        overflow: hidden;
    }

    .login-form {
        flex: 1.2;
        padding: 2rem;
    }

    .login-form h2 {
        color: #ffffff;
        text-align: center;
        text-shadow: none;
        font-weight: 700;
        margin-bottom: 1.5rem;
    }

    .login-image {
        flex: 1;
        background-image: url('/assets/img/Cas.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-color: rgba(0, 0, 0, 0.15);
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ccc;
        margin-bottom: 1rem;
    }

    .btn-pretty {
        margin-top: 0.5rem;
    }
</style>

<div class="login-container">
    <div class="login-wrapper">
        <!-- FORM ĐĂNG NHẬP -->
        <form class="login-form">
            <h2 class="note__title login-header" text-color = #000000>ĐĂNG NHẬP NGAY</h2>
            <div id="thongbao" class="text-sm text-red-500 mb-3"></div>

            <label class="menu-header text-sm font-bold" for="username">Tài khoản</label>
            <input class="form-control" id="username" type="text" placeholder="Tài khoản" required>

            <label class="menu-header text-sm font-bold" for="password">Mật khẩu</label>
            <input class="form-control" id="password" type="password" placeholder="Mật khẩu" required>

            <div class="flex items-center justify-between gap-2">
                <button id="Login" class="btn-pretty" type="button">Đăng nhập</button>
                <button class="btn-pretty" type="button" onclick="window.location.href='/public/client/Register.php'">
                    Đăng ký
                </button>
                                
            </div>
        </form>

        <!-- HÌNH ẢNH BÊN PHẢI -->
        <div class="login-image"></div>
    </div>
</div>

<script type="text/javascript">
    $("#Login").on("click", function () {
        $('#Login').html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý...').prop('disabled', true);
        $.ajax({
            url: "<?=BASE_URL('assets/ajaxs/Auth.php');?>",
            method: "POST",
            data: {
                type: 'Login',
                username: $("#username").val(),
                password: $("#password").val()
            },
            success: function (response) {
                $("#thongbao").html(response);
                $('#Login').html('Đăng nhập').prop('disabled', false);
            }
        });
    });
</script>

<?php require_once(__DIR__ . "/Footer.php"); ?>
