<?php
require_once(__DIR__ . "/Header.php")
?>
<style>
    .username-money {
        font-size: 18px; 
        font-weight: bold;
        color: #28a745;
        text-decoration: none; 
        padding: 10px 15px;
        border-radius: 5px;
        transition: all 0.3s ease; 
    }

    .username-money:hover {
        color: #007bff;
        background-color: #f1f1f1; 
    }

    .btn-pretty-user {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 25px;
        height: 52px;
        font-size: 18px;
        font-weight: bold;
        color: #e4defe;
        white-space: nowrap;
        background: url(/assets/img/genshi/img/btn_pretty.webp) no-repeat center center;
        background-size: 100% 100%;
        border: none;
        border-radius: 6px;
    }
</style>
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md nav-header mb-4">
        <div class="container">

            <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="fas fa-bars" style="text-shadow: 2px 2px 2px #000000;color: #fff;"></i></span>
            </button>

            <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                <!-- Left navbar links (Trang chủ) -->
                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a href="/index.php" class="nav-link menu-header shine-active"><i class="ficon fa-lg fa fa-home"></i></a>
                    </li>
                    <li class="nav-item dropdown" id="topUp_balance">
                        <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle menu-header ">Nạp tiền</a>
                        <ul class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
                            <li><a href="<?= empty($_SESSION['username']) ? '/public/client/Login.php' : '/public/client/Recharge.php'; ?>" class="dropdown-item "><i class="fas fa-money-check-alt mr-1"></i> Nạp bằng thẻ cào</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a href="<?= empty($_SESSION['username']) ? '/public/client/Login.php' : '/public/client/Bank.php'; ?>" class="dropdown-item"><i class="fas fa-university mr-1"></i> Nạp bằng bank, ví</a></li>
                        </ul>
                    </li>
                    <?php
                        $recharge_category = $CMSNT->get_row("SELECT * FROM category WHERE title = 'DỊCH VỤ NẠP GAME'");
                        $recharge_anchor = $recharge_category ? strtolower(str_replace(' ', '_', $recharge_category['title'])) : 'recharge_service';
                    ?>
                    <li class="nav-item">
                        <a href="../../index.php#<?=$recharge_anchor?>" class="nav-link menu-header">Nạp Game</a>
                    </li>
                                        
                    <li class="nav-item dropdown">
                        <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle menu-header">Lịch Sử Mua</a>
                        <ul class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
                            <li><a href="/public/client/HistoryAccount.php" class="dropdown-item "><i class="fas fa-history mr-1"></i> Tài khoản</a></li>
                            <li class="dropdown-divider"></li>
                            <!-- <li><a href="/public/client/HistoryAccountReroll.php" class="dropdown-item "><i class="fas fa-history mr-1"></i> Tài khoản Reroll</a></li>
                            <li class="dropdown-divider"></li> -->
                            <li><a href="/public/client/HistoryGameRecharge.php" class="dropdown-item "><i class="fas fa-history mr-1"></i> Nạp game</a></li>                                                                                 
                        </ul>
                    </li>
                    <style>
                        .dropdown-submenu>a::after{margin-right: -0.5rem;margin-top: -1rem;}
                    </style>

                    <li class="nav-item">
                         <a href="<?= empty($_SESSION['username']) ? '/public/client/Login.php' : '/public/client/HistoryRecharge.php'; ?>" class="nav-link menu-header">Kiểm Tra Đơn Nạp</a>
                    </li>
                </ul>
            </div>

            <!-- Right navbar links -->
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto" style="position: absolute;right: 0px;">
                <?php if(empty($_SESSION['username'])) { ?>
                    <li class="nav-item">
                        <a href="/public/client/Register.php"><button class="btn-pretty">Đăng ký</button></a>
                    </li>
                    <li class="nav-item">
                        <a href="/public/client/Login.php"><button class="btn-pretty">Đăng nhập</button></a>
                    </li>
                <?php } else {?>
                    <li class="nav-item">
                        <span class="mt-2">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <button class="btn-pretty-user">
                                    [<?= $getUser['id']; ?>] <?= $_SESSION['username']; ?>: <?= format_cash($getUser['money']); ?>
                                </button>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- <div class="dropdown-item" style="font-weight:bold;">Level: <?= $getUser['level']; ?></div> -->
                                <a class="dropdown-item" href="/public/client/AboutMe.php"><i class="fas fa-user mr-1"></i>Thông tin tài khoản</a>
                                <!-- <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/public/client/HistoryBalance.php"><i class="fas fa-money-bill-wave mr-1"></i> Biến động số dư</a> -->
                                <!-- <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/public/client/HistoryOther.php"><i class="fas fa-list mr-1"></i> Lịch sử khác</a> -->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/public/client/ChangePassword.php"><i class="fas fa-key mr-1"></i> Đổi mật khẩu</a>
                                <div class="dropdown-divider"></div>
                                <?php if ($getUser['level'] == 'admin') { ?>
                                    <a class="dropdown-item text-success" href="/public/admin/ConfirmRecharge.php"><i class="fas fa-check-circle mr-1"></i> Yêu cầu nạp thẻ</a>
                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item text-success" href="/public/admin/ConfirmGameRecharge.php"><i class="fas fa-check-circle mr-1"></i> Yêu cầu nạp game</a>
                                    <div class="dropdown-divider"></div>

                                    <div class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="#"><i class="fas fa-folder-open mr-1"></i> Quản lý danh mục - nhóm</a>
                                        <ul class="dropdown-menu shadow" style="position: absolute; left: -100%; top: 0; min-width: 250px;">
                                            <li><a class="dropdown-item" href="/public/admin/AddCategoryGroup.php"><i class="fas fa-plus mr-1"></i> Thêm danh mục - nhóm</a></li>
                                            <li><a class="dropdown-item" href="/public/admin/AddGroupRecharge.php"><i class="fas fa-plus mr-1"></i> Thêm gói nạp</a></li>
                                            <li><a class="dropdown-item" href="/public/admin/UpdateCategory.php"><i class="fas fa-edit mr-1"></i> Sửa danh mục</a></li>
                                            <li><a class="dropdown-item" href="/public/admin/UpdateGroup.php"><i class="fas fa-edit mr-1"></i> Sửa nhóm</a></li>
                                            <li><a class="dropdown-item" href="/public/admin/UpdateGroupRecharge.php"><i class="fas fa-edit mr-1"></i> Sửa gói nạp</a></li>
                                        </ul>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    
                                    <div class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="#"><i class="fas fa-users-cog mr-1"></i> Quản lý tài khoản</a>
                                        <ul class="dropdown-menu shadow" style="position: absolute; left: -100%; top: 0; min-width: 250px;">
                                            <li><a class="dropdown-item" href="/public/admin/AddAccounts.php"><i class="fas fa-plus mr-1"></i> Thêm tài khoản game</a></li>
                                            <li><a class="dropdown-item" href="/public/admin/UpdateAccounts.php"><i class="fas fa-edit mr-1"></i> Sửa tài khoản game</a></li>
                                        </ul>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                <?php } ?>
                                <a class="dropdown-item text-danger" href="/public/client/Logout.php"><i class="fas fa-sign-out-alt mr-1"></i> Đăng xuất</a>
                            </div>
                        </span>
                    </li>
                <?php }?>
                </li>
            </ul>
        </div>
    </nav>


