<?php
require_once(__DIR__."/../../config/config.php");
require_once(__DIR__."/../../config/function.php");
require_once("../../public/client/Header.php");
require_once("../../public/client/Nav.php");

CheckAdmin();

// Xử lý khi form được submit
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $groups = check_string($_POST['groups']);
    $username = check_string($_POST['username']);
    $password = check_string($_POST['password']);
    $chitiet = check_string($_POST['chitiet']);
    $level = check_string($_POST['level']);
    $fivestar = check_string($_POST['fivestar']);
    $server = check_string($_POST['server']);
    $img = check_string($_POST['img']);
    $money = check_string($_POST['money']);
    $status = 'Chưa bán';
    
    $listimg = check_string($_POST['listimg']);
    $listimg = str_replace("\r", "", $listimg);
    $listimg_array = explode("\n", $listimg);
    $listimg_array = array_map('trim', $listimg_array);
    $listimg_array = array_filter($listimg_array);
    $listimg = implode(", ", $listimg_array);

    $account_info = [
        'username' => $username,
        'password' => $password
    ];
    $account = "user: " . $username . ", pass: " . $password;

    // Validate dữ liệu
    if(empty($groups)) {
        msg_error('Vui lòng chọn nhóm tài khoản', '', 2000);
    }
    if(empty($username) || empty($password)) {
        msg_error('Vui lòng nhập đầy đủ thông tin tài khoản/mật khẩu', '', 2000);
    }
    if(empty($money)) {
        msg_error('Vui lòng nhập giá tiền', '', 2000);
    }

    // Thêm vào database
    $insert = $CMSNT->insert('accounts', [
        'groups' => $groups,
        'account' => $account,
        'chitiet' => $chitiet,
        'createdate' => gettime(),
        'updatedate' => gettime(),
        'username' => NULL,
        'level' => $level,
        'fivestar' => $fivestar,
        'server' => $server,
        'img' => $img,
        'money' => $money,
        'status' => $status,
        'listimg' => $listimg
    ]);

    if($insert) {
        msg_success('Thêm tài khoản thành công', '', 2000);
    } else {
        msg_error('Thêm tài khoản thất bại', '', 2000);
    }
}
?>

<style>
    .addaccount-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 2rem 0;
    }

    .addaccount-wrapper {
        display: flex;
        width: 100%;
        max-width: 1200px;
        background: rgba(255, 255, 255, 0.86);
        border-radius: 16px;
        box-shadow: 0 0 15px rgba(0,0,0,0.25);
        overflow: hidden;
    }

    .addaccount-form {
        flex: 1;
        padding: 2rem;
    }

    .addaccount-header {
        color: #000000;
        font-size: 26px;
        font-weight: 700;
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .addaccount-form label {
        color: #000000;
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-control {
        width: 100%;
        border-radius: 8px;
        border: 1px solid #ccc;
        margin-bottom: 1rem;
        background-color: #fff;
        color: #000;
    }

    .btn-addaccount {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        font-size: 16px;
        width: 100%;
        transition: all 0.3s;
    }

    .btn-addaccount:hover {
        background-color: #45a049;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-row {
        display: flex;
        gap: 1rem;
    }

    .form-col {
        flex: 1;
    }

    .account-info-row {
        display: flex;
        gap: 1rem;
    }

    .account-info-col {
        flex: 1;
    }
</style>

<div class="addaccount-container">
    <div class="addaccount-wrapper">
        <!-- FORM THÊM TÀI KHOẢN -->
        <form method="POST" class="addaccount-form">
            <h2 class="addaccount-header">THÊM TÀI KHOẢN MỚI</h2>
            
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label>Nhóm tài khoản</label>
                        <select name="groups" class="form-control" required>
                            <option value="">-- Chọn nhóm --</option>
                            <?php 
                            $groups = $CMSNT->get_list("SELECT * FROM `groups` WHERE category >= 2 AND category != 6");
                            foreach($groups as $group): 
                            ?>
                                <option value="<?=$group['id']?>"><?=$group['title']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Server</label>
                        <select name="server" class="form-control" required>
                            <option value="">-- Chọn server --</option>
                            <option value="Asia">Asia</option>
                            <option value="America">America</option>
                            <option value="Europe">Europe</option>
                            <option value="SEA">SEA</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Cấp độ</label>
                        <input type="text" name="level" class="form-control" placeholder="Nhập cấp độ tài khoản">
                    </div>
                </div>
                
                <div class="form-col">
                    <div class="form-group">
                        <label>Số nhân vật 5 sao</label>
                        <input type="number" name="fivestar" class="form-control" value="1" min="0">
                    </div>
                    
                    <div class="form-group">
                        <label>Giá tiền (VNĐ)</label>
                        <input type="number" name="money" class="form-control" placeholder="100000" required>
                    </div>
                    
                </div>
            </div>
            
            <div class="form-group">
                <label>Thông tin tài khoản</label>
                <div class="account-info-row">
                    <div class="account-info-col">
                        <input type="text" name="username" class="form-control" placeholder="Tên đăng nhập" required>
                    </div>
                    <div class="account-info-col">
                        <input type="text" name="password" class="form-control" placeholder="Mật khẩu" required>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label>Ảnh đại diện (URL)</label>
                <input type="text" name="img" class="form-control" placeholder="https://example.com/image.jpg">
            </div>
            
            <div class="form-group">
                <label>Danh sách ảnh (mỗi URL một dòng)</label>
                <textarea name="listimg" class="form-control" rows="3" placeholder="https://example.com/img1.jpg
https://example.com/img2.jpg"></textarea>
                <small class="text-muted">Nhập mỗi URL ảnh trên một dòng, sẽ được lưu dưới dạng cách nhau bởi dấu phẩy</small>
            </div>
            
            <div class="form-group">
                <label>Chi tiết tài khoản</label>
                <textarea name="chitiet" class="form-control" rows="5" placeholder="Mô tả chi tiết về tài khoản"></textarea>
            </div>
            
            <button type="submit" class="btn-addaccount">
                <i class="fas fa-save"></i> THÊM TÀI KHOẢN
            </button>
        </form>
    </div>
</div>

<?php
    require_once("../../public/client/Footer.php");
?>