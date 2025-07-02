<?php
require_once(__DIR__."/../../config/config.php");
require_once(__DIR__."/../../config/function.php");
require_once(__DIR__. "/Header.php");
require_once(__DIR__. "/Nav.php");

if(!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$account = $CMSNT->get_row("SELECT * FROM accounts WHERE id = '".check_string($_GET['id'])."'");
if(!$account) {
    header("Location: index.php");
    exit();
}

$group = $CMSNT->get_row("SELECT * FROM groups WHERE id = '".$account['groups']."'");
$category = $CMSNT->get_row("SELECT * FROM category WHERE id = '".$group['category']."'");

$canBuy = ($account['status'] == 'Chưa bán');
?>

<style>
.account-container {
    background: url('/assets/img/card_beautiful.png') no-repeat center center;
    background-size: cover;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    color: #634827;
    margin-bottom: 30px;
}

.account-header {
    text-align: center;
    margin-bottom: 30px;
    color: #634827;
    text-shadow: 0 2px 4px rgba(0,0,0,0.5);
}

.account-image {
    max-height: 400px;
    width: 100%;
    object-fit: cover;
    border-radius: 10px;
    margin: 0 auto 20px;
    display: block;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}

.account-details {
    background-color: rgba(255, 255, 255, 0.85);
    padding: 25px;
    border-radius: 10px;
    margin-bottom: 20px;
}

.detail-row {
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px solid #e0e0e0;
}

.detail-row:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.detail-label {
    font-weight: bold;
    color: #8a6232;
}

.detail-value {
    font-weight: 500;
}

.buy-btn {
    background: linear-gradient(135deg, #8a6232, #b68967);
    border: none;
    color: white;
    font-weight: bold;
    padding: 12px 25px;
    border-radius: 5px;
    font-size: 18px;
    transition: all 0.3s;
    display: block;
    width: 100%;
    margin-top: 20px;
}

.buy-btn:hover {
    background: linear-gradient(135deg, #b68967, #8a6232);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}

.buy-btn:disabled {
    background: #6c757d;
    cursor: not-allowed;
}

.img-thumbnail {
    height: 180px;
    object-fit: cover;
    width: 100%;
    margin-bottom: 15px;
    transition: transform 0.3s;
}

.img-thumbnail:hover {
    transform: scale(1.05);
}

.sold-badge {
    background: #dc3545;
    color: white;
    padding: 8px 15px;
    border-radius: 5px;
    font-weight: bold;
    text-align: center;
    margin-top: 20px;
}
</style>

<div class="container mt-4">
    <div class="account-container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: rgba(255,255,255,0.7); border-radius: 5px;">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="Groups.php?id=<?=$group['id']?>"><?=$group['title']?></a></li>
                <li class="breadcrumb-item active">Tài khoản #<?=$account['id']?></li>
            </ol>
        </nav>

        <div class="account-header">
            <h2>Tài khoản <?=$group['title']?></h2>
            <p class="mb-0">ID: <?=$account['id']?></p>
        </div>

        <div class="row">
            <!-- Main image - lớn hơn -->
            <div class="col-md-6">
                <a href="<?=htmlspecialchars($account['img'] ?? '/assets/img/default-banner.jpg')?>" 
                    data-lightbox="account-gallery" 
                    data-title="Ảnh đại diện tài khoản #<?=$account['id']?>">
                        <img src="<?=htmlspecialchars($account['img'] ?? '/assets/img/default-banner.jpg')?>" 
                            class="account-image" 
                            alt="Account Banner"
                            style="cursor: zoom-in;">
                </a>
            </div>

            <!-- Account details -->
            <div class="col-md-6">
                <div class="account-details">
                    <div class="detail-row">
                        <span class="detail-label">Mã tài khoản:</span>
                        <span class="detail-value"><?=$account['id']?></span>
                    </div>
                    
                    <div class="detail-row">
                        <span class="detail-label">Level:</span>
                        <span class="detail-value"><?=$account['level']?></span>
                    </div>
                    
                    <div class="detail-row">
                        <span class="detail-label">Server:</span>
                        <span class="detail-value"><?=$account['server']?></span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Nhân vật 5 sao:</span>
                        <span class="detail-value"><?=$account['fivestar']?></span>
                    </div>
                    
                    <div class="detail-row">
                        <span class="detail-label">Giá:</span>
                        <span class="detail-value text-danger fw-bold"><?=number_format($account['money'])?>đ</span>
                    </div>
                    
                    <?php if(!$canBuy): ?>
                        <div class="sold-badge">
                            <i class="fas fa-times-circle"></i> Tài khoản đã được bán
                        </div>
                    <?php elseif(isset($_SESSION['username'])): ?>
                        <button id="btnThanhToan" class="buy-btn">
                            <i class="fas fa-shopping-cart"></i> Mua ngay
                        </button>
                        <div id="thongbao" class="mt-2"></div>
                    <?php else: ?>
                        <a href="/public/client/Login.php" class="buy-btn">
                            <i class="fas fa-sign-in-alt"></i> Đăng nhập để mua
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Detailed description -->
        <div class="account-details mt-4">
            <h4 class="text-center mb-4" style="color: #8a6232;">Chi tiết tài khoản</h4>
            <div class="detail-description">
                <?=nl2br(htmlspecialchars($account['chitiet']))?>
            </div>
        </div>

        <?php 
        $images = [];
        if(!empty($account['listimg'])) {
            $images = array_map('trim', explode(',', $account['listimg']));
            $images = array_filter($images);
        }
        
        if(!empty($images)): ?>
        <div class="account-details mt-4">
            <h4 class="text-center mb-4" style="color: #8a6232;">Hình ảnh bổ sung</h4>
            <div class="row">
                <?php foreach($images as $index => $image): ?>
                <div class="col-md-4 mb-3">
                    <a href="<?=htmlspecialchars($image)?>" data-lightbox="account-images" data-title="Hình ảnh <?=$index+1?>">
                        <img src="<?=htmlspecialchars($image)?>" class="img-thumbnail" style="cursor: zoom-in;"
                            onerror="this.onerror=null;this.src='/assets/img/default-image.jpg';">
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<script>
    $("#btnThanhToan").on("click", function() {
        $('#btnThanhToan').html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled', true);

        Swal.fire({
            title: 'Xác Nhận Thanh Toán',
            text: "Bạn có đồng ý mua nick này không?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Mua ngay',
            cancelButtonText: 'Hủy bỏ'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?=BASE_URL('assets/ajaxs/Auth.php');?>",
                    method: "POST",
                    data: {
                        type: 'buy_account',
                        id: <?=$account['id'];?>
                    },
                    success: function(response) {
                        $("#thongbao").html(response);
                        $('#btnThanhToan').html('<i class="fas fa-shopping-cart"></i> Mua ngay').prop('disabled', false);
                    },
                
                });
            } else {
                $('#btnThanhToan').html('<i class="fas fa-shopping-cart"></i> Mua ngay').prop('disabled', false);
            }
        });
    });

    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true,
        'positionFromTop': 100,
        'showImageNumberLabel': true,
        'alwaysShowNavOnTouchDevices': true
    });

    

</script>

<?php
require_once(__DIR__ . "/Footer.php");
?>