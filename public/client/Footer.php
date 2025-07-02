<style>
    html, body {
        height: 100%;
        margin: 0;
    }

    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .wrapper {
        flex: 1 0 auto;
    }

    footer {
        margin-top: auto;
        background-color: #222;
        padding: 20px 0;
    }

    footer a {
        color: #00bcd4;
        text-decoration: none;
    }

    footer a:hover {
        text-decoration: underline;
    }

    .link-active {
        color: #fff;
        font-weight: bold;
        margin-bottom: 0.75rem;
    }

    .footer-contact i {
        color: #00bcd4;
        margin-right: 0.5rem;
    }

    .footer-contact p {
        margin: 0.5rem 0;
    }

    /* Nút nổi bên phải */
    .nav-fixed {
        position: fixed;
        bottom: 100px;
        right: 20px;
        list-style: none;
        z-index: 1000;
    }

    .nav-fixed li {
        margin: 10px 0;
        background-color: #0084ff;
        border-radius: 50%;
        width: 48px;
        height: 48px;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .nav-fixed li:hover {
        transform: scale(1.1);
    }

    .nav-fixed li a i {
        color: #fff;
    }
</style>

<footer class="sticky-footer">
    <div class="container-lg">
        <h2 class="guide__title mt-3">
            <a href="#"><img src="" style="margin-top: -8px;height: 45px"></a>
        </h2>
        <div class="row">
            <section class="col-12 col-lg-4">
                <div class="h h4 link-active">Về chúng tôi</div>
                <p class="mt-3 small">Shop chuyên cung cấp tài khoản game, hỗ trợ nhanh chóng và uy tín.</p>
            </section>

            <section class="col-12 col-lg-4">
                <div class="h h4 link-active">Quyền lợi khách hàng</div>
                <p>Chúng tôi luôn đặt quyền lợi khách hàng lên hàng đầu và hỗ trợ nhiệt tình để bạn có trải nghiệm tốt nhất.</p>
            </section>

            <section class="col-12 col-lg-4 footer-contact">
                <i class="fab fa-facebook-square fa-2x mr-2">
                </i>
                <i class="fab fa-youtube fa-2x"></i>
                <p class="mt-3 fw-bold"><i class="fa fa-phone mr-2"></i>Hotline: 0858823948</p>
                <p class="fw-bold"><i class="fa fa-clock mr-2"></i>Work time: 24/7</p>
                <p class="fw-bold"><i class="fa fa-map-marked-alt mr-2"></i>Address: Tp.Hồ Chí Minh</p>
            </section>
        </div>
    </div>
</footer>

<ul class="nav-fixed">
 <li class="nav-fixed-zalo"> <a target="_blank" href="https://zalo.me/<?=$CMSNT->site('hotline_zalo')?>"><img src="../../assets/img/images/icon/zalo.png" alt=""></a></li>
    <li class="nav-fixed-face"> 
        <a target="_blank" href="<?=$CMSNT->site('facebook_url')?>">
            <i class="fab fa-facebook-f fa-lg"></i>
        </a>
    </li>
    <li class="nav-fixed-phone"> 
        <a href="tel:0587289023">
            <i class="fa fa-phone fa-lg"></i>
        </a>
    </li>
</ul>

<!-- jQuery -->
<script src="/style/plugins/jquery/jquery.min.js" type="text/javascript"></script>
<!-- Bootstrap 4 -->
<script src="/style/plugins/bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="/style/dist/js/adminlte.min.js" type="text/javascript"></script>
<!-- Lightbox JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>


<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });

    // sweet alert
</script>
</body>