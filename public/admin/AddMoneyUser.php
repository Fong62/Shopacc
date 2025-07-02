<?php
require_once(__DIR__."/../../config/config.php");
require_once(__DIR__."/../../config/function.php");
require_once("../../public/client/Header.php");
require_once("../../public/client/Nav.php");

CheckAdmin();

$user_id = isset($_GET['id']) ? check_string($_GET['id']) : '';
$user_data = null;

// Lấy dữ liệu user nếu có ID
if(!empty($user_id)) {
    $user_data = $CMSNT->get_row("SELECT * FROM `users` WHERE `id` = '$user_id'");
    if(!$user_data) {
        msg_error('User không tồn tại', BASE_URL('public/admin/AddMoneyUser.php'), 2000);
    }
}
?>

<style>
    .search-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 2rem 0;
    }

    .search-wrapper {
        width: 100%;
        max-width: 1200px;
        background: rgba(255, 255, 255, 0.86);
        border-radius: 16px;
        box-shadow: 0 0 15px rgba(0,0,0,0.25);
        overflow: hidden;
        padding: 2rem;
    }

    .search-header {
        color: #000000;
        font-size: 26px;
        font-weight: 700;
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .form-control {
        width: 100%;
        border-radius: 8px;
        border: 1px solid #ccc;
        margin-bottom: 1rem;
        background-color: #fff;
        color: #000;
        padding: 8px 12px;
    }

    .btn-search {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-search:hover {
        background-color: #45a049;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .user-info {
        margin-top: 2rem;
        padding: 1.5rem;
        background-color: #f8f9fa;
        border-radius: 8px;
        display: <?=!empty($user_data) ? 'block' : 'none'?>;
    }

    .info-row {
        display: flex;
        margin-bottom: 1rem;
    }

    .info-label {
        width: 150px;
        font-weight: 600;
        color: #333;
    }

    .info-value {
        flex: 1;
        color: #000;
    }

    .status-active {
        color: #28a745;
        font-weight: 600;
    }

    .status-banned {
        color: #dc3545;
        font-weight: 600;
    }

    .add-money-form {
        margin-top: 2rem;
        padding: 1.5rem;
        background-color: #f1f1f1;
        border-radius: 8px;
    }

    .btn-add-money {
        background-color: #2196F3;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s;
        width: 100%;
        margin-top: 1rem;
    }

    .btn-add-money:hover {
        background-color: #0b7dda;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .search-id-input {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .search-id-input input {
        flex: 1;
        max-width: 300px;
    }
</style>

<div class="search-container">
    <div class="search-wrapper">
        <div id="thongbao"></div>
        <h2 class="search-header">Cộng tiền tài khoản</h2>
        
        <!-- Form tìm kiếm -->
        <div class="search-id-input">
            <input type="number" id="user_id" class="form-control" placeholder="Nhập ID user" value="<?=$user_id?>">
            <button onclick="window.location.href='AddMoneyUser.php?id=' + document.getElementById('user_id').value" 
                    class="btn-search">
                <i class="fas fa-search"></i> Tìm kiếm
            </button>
        </div>
        
        <!-- Hiển thị thông tin user -->
        <?php if(!empty($user_data)): ?>
        <div class="user-info" id="userInfo">
            <div class="info-row">
                <div class="info-label">ID:</div>
                <div class="info-value"><?=$user_data['id']?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Username:</div>
                <div class="info-value"><?=$user_data['username']?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Email:</div>
                <div class="info-value"><?=$user_data['email'] ?: 'Chưa cập nhật'?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Số dư:</div>
                <div class="info-value"><?=number_format($user_data['money'])?>đ</div>
            </div>
            <div class="info-row">
                <div class="info-label">Cấp độ:</div>
                <div class="info-value"><?=ucfirst($user_data['level'])?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Trạng thái:</div>
                <div class="info-value <?=$user_data['banned'] == 1 ? 'status-banned' : 'status-active'?>">
                    <?=$user_data['banned'] == 1 ? 'Banned' : 'Active'?>
                </div>
            </div>
            <div class="info-row">
                <div class="info-label">Ngày tạo:</div>
                <div class="info-value"><?=$user_data['createdate'] ? date('d/m/Y H:i:s', strtotime($user_data['createdate'])) : 'Không xác định'?></div>
            </div>
        </div>
        
        <!-- Form cộng tiền -->
        <div class="add-money-form">
            <h3 style="color: #000; margin-bottom: 1rem;">CỘNG TIỀN CHO USER</h3>
            <form id="addMoneyForm">
                <input type="hidden" name="username" value="<?=$user_data['username']?>">
                
                <div class="form-group">
                    <label>Số tiền cộng (VNĐ)</label>
                    <input type="number" name="amount" class="form-control" placeholder="Nhập số tiền" required>
                </div>
                
                <div class="form-group">
                    <label>Lý do</label>
                    <textarea name="note" class="form-control" rows="3" placeholder="Nhập lý do cộng tiền" required></textarea>
                </div>
                
                <button type="submit" class="btn-add-money">
                    <i class="fas fa-plus-circle"></i> CỘNG TIỀN
                </button>
            </form>
        </div>
        <?php endif; ?>
    </div>
</div>


<script>
$(document).ready(function() {
    $('#addMoneyForm').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var button = form.find('button[type="submit"]');
        
       button.html('<i class="fas fa-spinner fa-spin"></i> Đang xử lý...').prop('disabled', true);

        $.ajax({
            url: '<?=BASE_URL('assets/ajaxs/admin/AddMoneyUser.php');?>',
            method: 'POST',
            data: {
                type: 'AddMoney',
                username: $('[name="username"]').val(),
                amount: $('[name="amount"]').val(),
                note: $('[name="note"]').val()
            },
            success: function(response) {
                $("#thongbao").html(response);
                button.html('<i class="fas fa-plus-circle"></i> Cộng tiền').prop('disabled', false);
            }
        });
    });

    $('#user_id').focus();
    
    // Hiển thị thông tin user nếu có ID trong URL
    const urlParams = new URLSearchParams(window.location.search);
    const userId = urlParams.get('id');
    
    if(userId) {
        document.getElementById('userInfo').scrollIntoView({ behavior: 'smooth' });
    }
});
</script>

<?php 
require_once("../../public/client/Footer.php");
?>