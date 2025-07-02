<?php
require_once(__DIR__."/../../config/config.php");
require_once(__DIR__."/../../config/function.php");
require_once(__DIR__."/../../public/client/Header.php");
require_once(__DIR__."/../../public/client/Nav.php");

$user = AboutMe();

$group_id = isset($_GET['id']) ? check_string($_GET['id']) : '';
if (empty($group_id)) {
    header("Location: index.php");
    exit();
}

$group = $CMSNT->get_row("SELECT * FROM `groups` WHERE `id` = '$group_id'");
if (!$group) {
    msg_error("Nhóm dịch vụ không tồn tại", "/", 2000);
}

$category = $CMSNT->get_row("SELECT * FROM `category` WHERE `id` = '".$group['category']."'");

$packages = $CMSNT->get_list("SELECT * FROM `groups_napgame` WHERE `groups` = '$group_id' AND `display` = 'SHOW'");

// Xử lý khi submit form
if (isset($_POST['submit'])) {
    $username = $user['username'];
    $package_id = check_string($_POST['package_id']);
    $uid = check_string($_POST['uid']);
    $login_username = check_string($_POST['login_username']);
    $login_password = check_string($_POST['login_password']);
    $server = check_string($_POST['server']);
    $character_name = check_string($_POST['character_name']);
    $phone = check_string($_POST['phone']);
    $quantity = $_POST['quantity'];
    $note = check_string($_POST['note']);
    
    if (empty($login_username) || empty($server) || empty($package_id) || empty($uid)) {
        msg_error("Vui lòng nhập đầy đủ thông tin", "", 2000);
    }
    
    $package = $CMSNT->get_row("SELECT * FROM `groups_napgame` WHERE `id` = '$package_id'");
    if (!$package) {
        msg_error("Gói nạp không tồn tại", "", 2000);
    }
    
    $total_money = $package['money'] * $quantity;
    
    // Thêm vào order_napgame
    $insert = $CMSNT->insert("order_napgame", [
        'username' => $username,
        'groups' => $group_id,
        'groups_napgame' => $package_id,
        'uid' => $uid,
        'login_username' => $login_username,
        'login_password' => $login_password,
        'server' => $server,
        'character_name' => $character_name,
        'phone' => $phone,
        'quantity' => $quantity,
        'money' => $total_money,
        'note' => $note,
        'status' => 'xuly',
        'created_at' => gettime()
    ]);
    
    if ($insert) {
        msg_success("Đã tạo đơn nạp thành công!", "", 2000);
    } else {
        msg_error("Lỗi khi tạo đơn nạp", "", 2000);
    }
}
?>

<style>
    .recharge-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .recharge-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .recharge-header img {
        max-width: 100px;
        margin-bottom: 15px;
    }

    .recharge-title {
        font-size: 28px;
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
    }

    .recharge-content {
        display: flex;
        gap: 30px;
        margin-bottom: 40px;
    }
    .recharge-image {
        background: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        display: flex;
        flex-direction: column;
        align-self: flex-start; /* Thêm dòng này */
    }

    .recharge-image img {
        width: 100%;
        max-width: 400px;
        border-radius: 8px;
        margin: 0 auto 20px;
        display: block;
    }

    .recharge-notes {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
    }

    .recharge-notes h4 {
        font-size: 16px;
        margin-bottom: 10px;
        color: #333;
    }

    .recharge-notes ul {
        padding-left: 20px;
        margin-bottom: 0;
    }

    .recharge-notes li {
        margin-bottom: 5px;
        font-size: 14px;
    }

    .recharge-form {
        flex: 1;
        background: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: 600;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
    }

    select.form-control {
        height: 40px;
    }

    .btn-recharge {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 600;
        width: 100%;
        transition: all 0.3s;
        font-size: 16px;
    }

    .btn-recharge:hover {
        background-color: #45a049;
    }

    @media (max-width: 768px) {
        .recharge-content {
            flex-direction: column;
        }
    }

    .package-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 15px;
        margin-bottom: 20px;
    }

    .package-item {
        background: #ffffff;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        padding: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .package-item:hover {
        border-color: #4CAF50;
        transform: translateY(-2px);
    }

    .package-item.active {
        border-color: #4CAF50;
        background-color: #f8fff8;
    }

    .package-title {
        font-weight: 600;
        font-size: 16px;
        color: #333;
        margin-bottom: 5px;
    }

    .package-price {
        color: #4CAF50;
        font-size: 14px;
        font-weight: 500;
    }

    .selected-package {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: none;
    }
.recharge-content {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 30px;
    }

    .package-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 10px;
        margin: 15px 0;
    }

    .package-item {
        padding: 12px;
        border-width: 1px;
    }

    .package-title {
        font-size: 14px;
    }

    .package-price {
        font-size: 13px;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }

    @media (max-width: 768px) {
        .recharge-content {
            grid-template-columns: 1fr;
        }
        
        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="recharge-container">
    <div class="recharge-header">
        <img src="<?=$category['img']?>" alt="<?=$group['title']?>">
        <h1 class="guide__title"><?=$category['title']?></h1>
        <h2 class="guide__title"><?=$group['title']?></h2>
    </div>
    
    <div class="recharge-content">
        <div class="recharge-image">
            <div style="text-align: center; margin-bottom: 20px;">
                <img src="<?=$group['img']?>" alt="<?=$group['title']?>" style="max-width: 100%">
                <h3 style="margin: 10px 0;"><?=$group['title']?></h3>
            </div>
            
            <div class="recharge-notes">
                <h4>Lưu ý khi nạp game:</h4>
                <ul>
                    <li>Đơn nạp sẽ được xử lí trong vòng 24h</li>
                    <li>Tất cả gói nạp đều được X2 như trong game</li>
                    <li>Chỉ nhận login bằng tài khoản</li>
                    <li>Liên hệ Zalo <?=$CMSNT->site('hotline_zalo')?> nếu cần hỗ trợ</li>
                </ul>
            </div>
        </div>
        
        <div class="recharge-form">
            <form method="POST">
                <label>Chọn gói nạp</label>
                <div class="selected-package" id="selectedPackage">
                    Đã chọn: <span id="selectedTitle"></span> - <span id="selectedPrice"></span>
                </div>

                <div class="package-grid">
                    <?php foreach($packages as $package): ?>
                    <div class="package-item" 
                        data-id="<?=$package['id']?>"
                        data-title="<?=$package['title']?>"
                        data-price="<?=format_cash($package['money'])?>">
                        <div class="package-title"><?=$package['title']?></div>
                        <div class="package-price"><?=format_cash($package['money'])?>đ</div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <input type="hidden" name="package_id" id="packageInput" required>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Số lượng</label>
                        <input type="number" name="quantity" class="form-control" value="1" min="1" required>
                    </div>
                    
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>UID (User ID)</label>
                        <input type="text" name="uid" class="form-control" placeholder="Nhập UID" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Server</label>
                        <input type="text" name="server" class="form-control" placeholder="Nhập server" required>
                    </div>
                    
                    
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Tên nhân vật</label>
                        <input type="text" name="character_name" class="form-control" placeholder="Tên nhân vật">
                    </div>

                    <div class="form-group">
                        <label>Tên đăng nhập</label>
                        <input type="text" name="login_username" class="form-control" placeholder="Tên đăng nhập" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input type="password" name="login_password" class="form-control" placeholder="Mật khẩu">
                    </div>

                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="text" name="phone" class="form-control" placeholder="SĐT">
                    </div>
                </div>

                <div class="form-group">
                    <label>Ghi chú</label>
                    <textarea name="note" class="form-control" rows="2" placeholder="Thêm ghi chú hoặc đường link zalo, fb của bạn"></textarea>
                </div>
                
                <button type="submit" name="submit" class="btn-recharge">
                    <i class="fas fa-paper-plane"></i> Gửi yêu cầu nạp
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.package-item').forEach(item => {
    item.addEventListener('click', function() {
        // Xóa active tất cả các item
        document.querySelectorAll('.package-item').forEach(i => i.classList.remove('active'));
        
        // Thêm active cho item được chọn
        this.classList.add('active');
        
        // Cập nhật input hidden
        document.getElementById('packageInput').value = this.dataset.id;
        
        // Hiển thị thông tin đã chọn
        const selectedDiv = document.getElementById('selectedPackage');
        selectedDiv.style.display = 'block';
        document.getElementById('selectedTitle').textContent = this.dataset.title;
        document.getElementById('selectedPrice').textContent = this.dataset.price + 'đ';
    });
});
</script>

<?php
require_once(__DIR__."/../../public/client/Footer.php");
?>
