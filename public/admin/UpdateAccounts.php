<?php
require_once(__DIR__."/../../config/config.php");
require_once(__DIR__."/../../config/function.php");
require_once("../../public/client/Header.php");
require_once("../../public/client/Nav.php");

CheckAdmin();

$account_id = isset($_GET['id']) ? check_string($_GET['id']) : '';
$account_data = null;

// Lấy dữ liệu tài khoản nếu có ID
if(!empty($account_id)) {
    $account_data = $CMSNT->get_row("SELECT * FROM `accounts` WHERE `id` = '$account_id'");
    if(!$account_data) {
        msg_error('Tài khoản không tồn tại', BASE_URL('public/admin/UpdateAccounts.php'), 2000);
    }
}

// Xử lý khi form được submit
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['update_account'])) {
        $account_id = check_string($_POST['account_id']);
        $groups = check_string($_POST['groups']);
        $username = check_string($_POST['username']);
        $password = check_string($_POST['password']);
        $chitiet = check_string($_POST['chitiet']);
        $level = check_string($_POST['level']);
        $fivestar = check_string($_POST['fivestar']);
        $server = check_string($_POST['server']);
        $img = check_string($_POST['img']);
        $money = check_string($_POST['money']);
        $status = check_string($_POST['status']);
        
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
        $account = "user:" . $username . ", pass:" . $password;

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

        // Cập nhật vào database
        $update = $CMSNT->update('accounts', [
            'groups' => $groups,
            'account' => $account,
            'chitiet' => $chitiet,
            'updatedate' => gettime(),
            'level' => $level,
            'fivestar' => $fivestar,
            'server' => $server,
            'img' => $img,
            'money' => $money,
            'status' => $status,
            'listimg' => $listimg
        ], "id = '$account_id'");

        if($update) {
            msg_success('Cập nhật tài khoản thành công', BASE_URL('public/admin/UpdateAccounts.php'), 2000);
        } else {
            msg_error('Cập nhật tài khoản thất bại', '', 2000);
        }
    }
}

// Lấy danh sách nhóm để hiển thị trong dropdown
$groups = $CMSNT->get_list("SELECT * FROM `groups` WHERE category >= 2");

// Lấy danh sách tài khoản để hiển thị trong bảng
$accounts = $CMSNT->get_list("SELECT a.id, a.account, a.money, a.status, g.title as group_name 
    FROM `accounts` a 
    LEFT JOIN `groups` g ON a.groups = g.id 
    ORDER BY a.id ASC");
?>

<style>
    .update-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 2rem 0;
    }

    .update-wrapper {
        width: 100%;
        max-width: 1200px;
        background: rgba(255, 255, 255, 0.86);
        border-radius: 16px;
        box-shadow: 0 0 15px rgba(0,0,0,0.25);
        overflow: hidden;
        padding: 2rem;
    }

    .update-header {
        color: #000000;
        font-size: 26px;
        font-weight: 700;
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .account-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 2rem;
    }

    .account-table th, .account-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .account-table th {
        background-color: #f8f9fa;
        font-weight: 600;
    }

    .account-table tr:hover {
        background-color: #f5f5f5;
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

    .btn-update {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-update:hover {
        background-color: #45a049;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .btn-select {
        background-color: #45a049;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-select:hover {
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

    .status-available {
        color: #28a745;
        font-weight: 600;
    }

    .status-sold {
        color: #dc3545;
        font-weight: 600;
    }

    .edit-form {
        display: <?=!empty($account_data) ? 'block' : 'none'?>;
        margin-top: 2rem;
        padding: 1.5rem;
        background-color: #f8f9fa;
        border-radius: 8px;
    }

    .account-id-input {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .account-id-input input {
        flex: 1;
        max-width: 200px;
    }

    .image-preview {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }

    .image-preview img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #ddd;
        transition: transform 0.3s;
    }

    .image-preview img:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .btn-icon {
        font-size: 14px;
    }
</style>

<div class="update-container">
    <div class="update-wrapper">
        <h2 class="update-header">CẬP NHẬT TÀI KHOẢN GAME</h2>
        
        <!-- Form chọn ID tài khoản -->
        <div class="account-id-input">
            <input type="text" id="account_id_input" class="form-control" placeholder="Nhập ID tài khoản" value="<?=$account_id?>">
            <button onclick="window.location.href='UpdateAccounts.php?id=' + document.getElementById('account_id_input').value" 
                    class="btn-select">
                <i class="fas fa-search btn-icon"></i> Tìm kiếm
            </button>
        </div>
        
        <!-- Bảng hiển thị danh sách tài khoản -->
        <table class="account-table">
            <thead>
                <tr>
                    <th width="80px">ID</th>
                    <th>Nhóm</th>
                    <th>Tài khoản</th>
                    <th width="120px">Giá tiền</th>
                    <th width="120px">Trạng thái</th>
                    <th width="120px">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($accounts as $account): ?>
                <tr>
                    <td><?=$account['id']?></td>
                    <td><?=$account['group_name']?></td>
                    <td><?=substr($account['account'], 0, 50)?>...</td>
                    <td><?=number_format($account['money'])?>đ</td>
                    <td class="<?=$account['status'] == 'Chưa bán' ? 'status-available' : 'status-sold'?>">
                        <?=$account['status']?>
                    </td>
                    <td>
                        <a href="UpdateAccounts.php?id=<?=$account['id']?>" class="btn-select">
                            <i class="fas fa-edit btn-icon"></i> Sửa
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <!-- Form cập nhật (chỉ hiển thị khi có ID) -->
        <div class="edit-form" id="editForm">
            <?php if(!empty($account_data)): ?>
            <form method="POST">
                <input type="hidden" name="account_id" value="<?=$account_data['id']?>">
                
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label>Nhóm tài khoản</label>
                            <select name="groups" class="form-control" required>
                                <option value="">-- Chọn nhóm --</option>
                                <?php foreach($groups as $group): ?>
                                    <option value="<?=$group['id']?>" <?=($group['id'] == $account_data['groups']) ? 'selected' : ''?>>
                                        <?=$group['title']?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Server</label>
                            <select name="server" class="form-control" required>
                                <option value="">-- Chọn server --</option>
                                <option value="Asia" <?=($account_data['server'] == 'Asia') ? 'selected' : ''?>>Asia</option>
                                <option value="America" <?=($account_data['server'] == 'America') ? 'selected' : ''?>>America</option>
                                <option value="Europe" <?=($account_data['server'] == 'Europe') ? 'selected' : ''?>>Europe</option>
                                <option value="SEA" <?=($account_data['server'] == 'SEA') ? 'selected' : ''?>>SEA</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Cấp độ</label>
                            <input type="text" name="level" class="form-control" value="<?=$account_data['level']?>" placeholder="Nhập cấp độ tài khoản">
                        </div>
                    </div>
                    
                    <div class="form-col">
                        <div class="form-group">
                            <label>Số nhân vật 5 sao</label>
                            <input type="number" name="fivestar" class="form-control" value="<?=$account_data['fivestar']?>" min="0">
                        </div>
                        
                        <div class="form-group">
                            <label>Giá tiền (VNĐ)</label>
                            <input type="number" name="money" class="form-control" value="<?=$account_data['money']?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select name="status" class="form-control" required>
                                <option value="Chưa bán" <?=($account_data['status'] == 'Chưa bán') ? 'selected' : ''?>>Chưa bán</option>
                                <option value="Đã bán" <?=($account_data['status'] == 'Đã bán') ? 'selected' : ''?>>Đã bán</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Thông tin tài khoản</label>
                    <div class="account-info-row">
                        <div class="account-info-col">
                            <?php
                            // Parse username from account field
                            $account_info = $account_data['account'];
                            $username = '';
                            if(preg_match('/user:([^,]+)/', $account_info, $matches)) {
                                $username = trim($matches[1]);
                            }
                            ?>
                            <input type="text" name="username" class="form-control" value="<?=$username?>" placeholder="Tên đăng nhập" required>
                        </div>
                        <div class="account-info-col">
                            <?php
                            // Parse password from account field
                            $password = '';
                            if(preg_match('/pass:([^,]+)/', $account_info, $matches)) {
                                $password = trim($matches[1]);
                            }
                            ?>
                            <input type="text" name="password" class="form-control" value="<?=$password?>" placeholder="Mật khẩu" required>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Ảnh đại diện (URL)</label>
                    <input type="text" name="img" class="form-control" value="<?=$account_data['img']?>" placeholder="https://example.com/image.jpg">
                    <?php if(!empty($account_data['img'])): ?>
                        <div class="image-preview">
                            <img src="<?=$account_data['img']?>" alt="Ảnh đại diện">
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label>Danh sách ảnh (mỗi URL một dòng)</label>
                    <textarea name="listimg" class="form-control" rows="3" placeholder="https://example.com/img1.jpg
https://example.com/img2.jpg"><?=str_replace(", ", "\n", $account_data['listimg'])?></textarea>
                    <?php if(!empty($account_data['listimg'])): 
                        $list_images = explode(", ", $account_data['listimg']);
                    ?>
                        <div class="image-preview">
                            <?php foreach($list_images as $image): 
                                if(!empty(trim($image))): ?>
                                    <img src="<?=trim($image)?>" alt="Ảnh minh họa">
                                <?php endif;
                            endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label>Chi tiết tài khoản</label>
                    <textarea name="chitiet" class="form-control" rows="5" placeholder="Mô tả chi tiết về tài khoản"><?=$account_data['chitiet']?></textarea>
                </div>
                
                <button type="submit" name="update_account" class="btn-update" style="width: 100%; padding: 12px;">
                    <i class="fas fa-save"></i> CẬP NHẬT TÀI KHOẢN
                </button>
            </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    // Hiển thị form chỉnh sửa nếu có ID trong URL
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const accountId = urlParams.get('id');
        
        if(accountId) {
            document.getElementById('editForm').style.display = 'block';
            document.getElementById('account_id_input').value = accountId;
            // Cuộn đến form chỉnh sửa
            document.getElementById('editForm').scrollIntoView({ behavior: 'smooth' });
        }
    });
</script>

<?php
    require_once("../../public/client/Footer.php");
?>