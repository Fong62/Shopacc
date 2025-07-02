<?php
require_once(__DIR__."/../../config/config.php");
require_once(__DIR__."/../../config/function.php");
require_once(__DIR__. "/Header.php");
require_once(__DIR__. "/Nav.php");

// Kiểm tra đăng nhập
CheckLogin();

// Lấy thông tin user
$user = AboutMe();
if(!$user) {
    header("Location: index.php");
    exit();
}

// // DEBUG - Hiển thị thông tin user
// echo '<div class="alert alert-info debug-info" style="position: fixed; bottom: 10px; right: 10px; z-index: 1000; display: none;">';
// echo '<h4>Thông tin Debug</h4>';
// echo '<pre>User Level: '.$user['level'].'</pre>';
// echo '<pre>Is Admin: '.(($user['level'] == 'admin') ? 'YES' : 'NO').'</pre>';
// echo '</div>';
// ?>

<style>
.profile-container {
    background: url('/assets/img/card_beautiful.png') no-repeat center center;
    background-size: cover;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    color: #634827;
    margin-bottom: 30px;
}

.profile-header {
    text-align: center;
    margin-bottom: 30px;
    color: #634827;
    text-shadow: 0 2px 4px rgba(0,0,0,0.5);
}

.profile-avatar {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 5px solid rgba(255,255,255,0.8);
    margin: 0 auto 20px;
    display: block;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}

.profile-details {
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
    width: 150px;
    display: inline-block;
}

.detail-value {
    font-weight: 500;
}

.action-btn {
    background: linear-gradient(135deg, #8a6232, #b68967);
    border: none;
    color: white;
    font-weight: bold;
    padding: 12px 25px;
    border-radius: 5px;
    font-size: 18px;
    transition: all 0.3s;
    display: inline-block;
    margin: 10px 5px;
    text-align: center;
    text-decoration: none;
}

.action-btn:hover {
    background: linear-gradient(135deg, #b68967, #8a6232);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    color: white;
}

.banned-badge {
    background: #dc3545;
    color: white;
    padding: 8px 15px;
    border-radius: 5px;
    font-weight: bold;
    text-align: center;
    margin-top: 20px;
}

.admin-badge {
    background: #28a745;
    color: white;
    padding: 8px 15px;
    border-radius: 5px;
    font-weight: bold;
    text-align: center;
    margin-top: 20px;
}

.history-item {
    background-color: rgba(255,255,255,0.8);
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 15px;
    transition: all 0.3s;
}

.history-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.tab-content {
    padding: 20px;
    background-color: rgba(255,255,255,0.85);
    border-radius: 0 0 10px 10px;
}

.nav-tabs .nav-link.active {
    background-color: rgba(255,255,255,0.85);
    color: #8a6232;
    font-weight: bold;
    border-bottom: 3px solid #8a6232;
}

.nav-tabs .nav-link {
    color: #634827;
    border: none;
    padding: 12px 20px;
    font-weight: 500;
}

.nav-tabs .nav-link:hover {
    border: none;
    color: #8a6232;
}
</style>

<div class="container mt-4">
    <div class="profile-container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: rgba(255,255,255,0.7); border-radius: 5px;">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item active">Thông tin tài khoản</li>
            </ol>
        </nav>

        <div class="profile-header">
            <img src="/assets/img/default-avatar.jpg" class="profile-avatar" alt="User Avatar">
            <h2>Thông tin tài khoản</h2>
            <p class="mb-0">Xin chào, <?=$user['username']?>!</p>
        </div>

        <!-- Tab navigation -->
        <ul class="nav nav-tabs" id="profileTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab">Thông tin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="history-tab" data-toggle="tab" href="#history" role="tab">Lịch sử giao dịch</a>
            </li>
            <?php if($user['level'] == 'admin'): ?>
            <li class="nav-item">
                <a class="nav-link" id="admin-tab" data-toggle="tab" href="#admin" role="tab">Quản trị</a>
            </li>
            <?php endif; ?>
        </ul>

        <!-- Tab content -->
        <div class="tab-content" id="profileTabContent">
            <!-- Thông tin cá nhân -->
            <div class="tab-pane fade show active" id="info" role="tabpanel">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="profile-details">
                            <h4 class="text-center mb-4" style="color: #8a6232;">Thông tin cơ bản</h4>
                            <div class="detail-row">
                                <span class="detail-label">Tên đăng nhập:</span>
                                <span class="detail-value"><?=$user['username']?></span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Số dư:</span>
                                <span class="detail-value text-danger fw-bold"><?=format_cash($user['money'])?>đ</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Cấp độ:</span>
                                <span class="detail-value"><?=ucfirst($user['level'])?></span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Ngày tạo:</span>
                                <span class="detail-value"><?=!empty($user['createdate']) ? format_date(strtotime($user['createdate'])) : 'Không xác định'?></span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Email:</span>
                                <span class="detail-value"><?=!empty($user['email']) ?   htmlspecialchars($user['email']):'Chưa cập nhật'
                                 ?></span>
                            </div>
                            <?php if($user['banned'] == 1): ?>
                                <div class="banned-badge"><i class="fas fa-ban"></i> Tài khoản đã bị khóa</div>
                            <?php elseif($user['level'] == 'admin'): ?>
                                <div class="admin-badge"><i class="fas fa-crown"></i> Quản trị viên</div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="profile-details">
                            <h4 class="text-center mb-4" style="color: #8a6232;">Thao tác</h4>
                            <a href="/public/client/ChangePassword.php" class="action-btn"><i class="fas fa-key"></i> Đổi mật khẩu</a>
                            <a href="/public/client/Recharge.php" class="action-btn"><i class="fas fa-money-bill-wave"></i> Nạp tiền</a>
                            <a href="/public/client/History.php" class="action-btn"><i class="fas fa-history"></i> Lịch sử GD</a>
                            <?php if($user['level'] == 'admin'): ?>
                                <a href="/admin" class="action-btn" style="background: linear-gradient(135deg, #6f42c1, #a37cf0);"><i class="fas fa-cog"></i> Trang quản trị</a>
                            <?php endif; ?>
                            <a href="/public/client/Logout.php" class="action-btn" style="background: linear-gradient(135deg, #dc3545, #f0828c);"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lịch sử giao dịch -->
            <div class="tab-pane fade" id="history" role="tabpanel">
                <h4 class="text-center mb-4" style="color: #8a6232;">Lịch sử giao dịch gần đây</h4>
                <?php
                $transactions = $CMSNT->get_list("SELECT * FROM `cards` WHERE `username` = '".addslashes($user['username'])."' ORDER BY `id` DESC LIMIT 5");
                if(empty($transactions)): ?>
                    <div class="alert alert-info text-center"><i class="fas fa-info-circle"></i> Bạn chưa có giao dịch nào</div>
                <?php else:
                    foreach($transactions as $t):
                        switch($t['status']) {
                            case 'hoanthanh':   $badge = '<span class="badge badge-success">Thành công</span>'; break;
                            case 'huy':     $badge = '<span class="badge badge-danger">Thất bại</span>'; break;
                            case 'xuly':     $badge = '<span class="badge badge-warning">Đang chờ</span>'; break;
                            default:            $badge = '<span class="badge badge-secondary">'.htmlspecialchars($t['status']).'</span>';
                        }
                ?>
                    <div class="history-item">
                        <div class="row">
                            <div class="col-md-4"><strong>Mã GD:</strong> <?=$t['id']?></div>
                            <div class="col-md-4"><strong>Loại:</strong> <?=htmlspecialchars($t['loaithe'])?></div>
                            <div class="col-md-4"><strong>Số tiền:</strong>
                                <span class="<?= $t['menhgia']>0?'text-success':'text-danger' ?>">
                                    <?= ($t['menhgia']>0?'+':'').format_cash($t['menhgia']) ?>đ
                                </span>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <strong>Thời gian:</strong> <?=format_date(strtotime($t['createdate']))?><br>
                                <strong>Trạng thái:</strong> <?=$badge?><br>
                                <?php if(!empty($t['note'])): ?>
                                    <strong>Ghi chú:</strong> <?=htmlspecialchars($t['note'])?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                    <div class="text-center mt-3">
                        <a href="/public/client/History.php" class="action-btn"><i class="fas fa-list"></i> Xem toàn bộ lịch sử</a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Quản trị (chỉ admin) -->
            <?php if($user['level'] == 'admin'): ?>
            <div class="tab-pane fade" id="admin" role="tabpanel">
                <h4 class="text-center mb-4" style="color: #8a6232;">Công cụ quản trị</h4>
                <div class="row text-center">
                    <div class="col-6 col-md-3 mb-3">
                        <a href="/public/admin/Accounts.php" class="action-btn" style="background: linear-gradient(135deg, #17a2b8, #5bc0de);">
                            <i class="fas fa-users-cog"></i><br>Quản lý tài khoản
                        </a>
                    </div>
                    <div class="col-6 col-md-3 mb-3">
                        <a href="/public/admin/AddAccounts.php" class="action-btn" style="background: linear-gradient(135deg, #ffc107, #ffd351); color:#212529;">
                            <i class="fas fa-exchange-alt"></i><br>Thêm tài khoản
                        </a>
                    </div>
                    <div class="col-6 col-md-3 mb-3">
                        <a href="/public/admin/AddCategoryGroup.php" class="action-btn" style="background: linear-gradient(135deg, #6f42c1, #a37cf0);">
                            <i class="fas fa-cogs"></i><br>Thêm danh mục
                        </a>
                    </div>
                    <div class="col-6 col-md-3 mb-3">
                        <div class="profile-details">
                            <h5 class="mb-2">Thống kê nhanh</h5>
                            <p>Tổng số dư users: <?=format_cash($CMSNT->get_row("SELECT SUM(money) AS total FROM users")['total'])?>đ</p>
                            <p>Thành viên: <?=$CMSNT->num_rows("SELECT id FROM users")?></p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 mb-3">
                        <a href="/public/admin/AddMoneyUser.php" class="action-btn" style="background: linear-gradient(135deg, #6f42c1, #a37cf0);">
                            <i class="fas fa-cogs"></i><br>Cộng tiền tài khoản
                        </a>
                    </div>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>
</div>


<script>

$(function(){
    $('#profileTab a').on('click', function(e){
        e.preventDefault();
        $(this).tab('show');
        localStorage.setItem('activeTab', $(this).attr('href'));
    });

    // Lấy activeTab, nếu không có thì dùng '#info'
    var activeTab = localStorage.getItem('activeTab') || '#info';
    $('#profileTab a[href="' + activeTab + '"]').tab('show');
});
</script>
<?php require_once(__DIR__ . "/Footer.php"); ?>

