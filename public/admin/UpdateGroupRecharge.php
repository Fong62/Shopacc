<?php
require_once(__DIR__."/../../config/config.php");
require_once(__DIR__."/../../config/function.php");
require_once("../../public/client/Header.php");
require_once("../../public/client/Nav.php");

CheckAdmin();

// Lấy danh mục DỊCH VỤ NẠP GAME
$category_nap = $CMSNT->get_row("SELECT id FROM category WHERE title = 'DỊCH VỤ NẠP GAME'");
$groups_nap = $CMSNT->get_list("SELECT * FROM groups WHERE category = '".$category_nap['id']."'");

$group_id = isset($_GET['group_id']) ? check_string($_GET['group_id']) : '';
$recharge_id = isset($_GET['id']) ? check_string($_GET['id']) : '';
$recharge_data = null;

// Lấy dữ liệu gói nạp nếu có ID
if(!empty($recharge_id)) {
    $recharge_data = $CMSNT->get_row("SELECT * FROM `groups_napgame` WHERE `id` = '$recharge_id'");
    if(!$recharge_data) {
        msg_error('Gói nạp không tồn tại', BASE_URL('public/admin/UpdateGroupRecharge.php'), 2000);
    }
}

// Xử lý khi form được submit
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['update_recharge'])) {
        $id = check_string($_POST['id']);
        $title = check_string($_POST['title']);
        $money = check_string($_POST['money']);
        $display = check_string($_POST['display']);
        
        // Validate dữ liệu
        if(empty($title)) {
            msg_error('Vui lòng nhập tên gói nạp', '', 2000);
        }
        if(empty($money)) {
            msg_error('Vui lòng nhập giá tiền', '', 2000);
        }

        // Cập nhật vào database
        $update = $CMSNT->update('groups_napgame', [
            'title' => $title,
            'money' => $money,
            'display' => $display
        ], "id = '$id'");

        if($update) {
            msg_success('Cập nhật gói nạp thành công', BASE_URL('public/admin/UpdateGroupRecharge.php?group_id='.$group_id), 2000);
        } else {
            msg_error('Cập nhật gói nạp thất bại', '', 2000);
        }
    }
}

// Lấy danh sách gói nạp theo nhóm
$recharges = [];
if(!empty($group_id)) {
    $recharges = $CMSNT->get_list("SELECT * FROM groups_napgame WHERE groups = '$group_id' ORDER BY money ASC");
}
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

    .recharge-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 2rem;
    }

    .recharge-table th, .recharge-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .recharge-table th {
        background-color: #f8f9fa;
        font-weight: 600;
    }

    .recharge-table tr:hover {
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

    .recharge-info-row {
        display: flex;
        gap: 1rem;
    }

    .recharge-info-col {
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
        display: <?=!empty($recharge_data) ? 'block' : 'none'?>;
        margin-top: 2rem;
        padding: 1.5rem;
        background-color: #f8f9fa;
        border-radius: 8px;
    }

    .recharge-id-input {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .recharge-id-input input {
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
        <h2 class="update-header">CẬP NHẬT GÓI NẠP GAME</h2>
        
        <!-- Form chọn nhóm -->
        <div class="recharge-id-input">
            <select id="group_select" class="form-control">
                <option value="">-- Chọn nhóm dịch vụ --</option>
                <?php foreach($groups_nap as $group): ?>
                <option value="<?=$group['id']?>" <?=($group['id'] == $group_id) ? 'selected' : ''?>>
                    <?=$group['title']?>
                </option>
                <?php endforeach; ?>
            </select>
            <button onclick="window.location.href='UpdateGroupRecharge.php?group_id=' + document.getElementById('group_select').value" 
                    class="btn-select">
                <i class="fas fa-search btn-icon"></i> Tìm kiếm
            </button>
        </div>
        
        <!-- Bảng hiển thị danh sách gói nạp -->
        <table class="recharge-table">
            <thead>
                <tr>
                    <th width="80px">ID</th>
                    <th>Tên gói</th>
                    <th width="150px">Giá tiền</th>
                    <th width="120px">Trạng thái</th>
                    <th width="120px">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($recharges as $recharge): ?>
                <tr>
                    <td><?=$recharge['id']?></td>
                    <td><?=$recharge['title']?></td>
                    <td><?=number_format($recharge['money'])?>đ</td>
                    <td class="<?=$recharge['display'] == 'SHOW' ? 'status-available' : 'status-sold'?>">
                        <?=$recharge['display']?>
                    </td>
                    <td>
                        <a href="UpdateGroupRecharge.php?group_id=<?=$group_id?>&id=<?=$recharge['id']?>" class="btn-select">
                            <i class="fas fa-edit btn-icon"></i> Sửa
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <!-- Form cập nhật -->
        <div class="edit-form" id="editForm">
            <?php if(!empty($recharge_data)): ?>
            <form method="POST">
                <input type="hidden" name="id" value="<?=$recharge_data['id']?>">
                
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label>Tên gói nạp</label>
                            <input type="text" name="title" class="form-control" 
                                value="<?=$recharge_data['title']?>" required>
                        </div>
                    </div>
                    
                    <div class="form-col">
                        <div class="form-group">
                            <label>Giá tiền (VNĐ)</label>
                            <input type="number" name="money" class="form-control" 
                                value="<?=$recharge_data['money']?>" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Trạng thái</label>
                    <select name="display" class="form-control" required>
                        <option value="SHOW" <?=($recharge_data['display'] == 'SHOW') ? 'selected' : ''?>>Hiển thị</option>
                        <option value="HIDE" <?=($recharge_data['display'] == 'HIDE') ? 'selected' : ''?>>Ẩn</option>
                    </select>
                </div>

                <button type="submit" name="update_recharge" class="btn-update" style="width: 100%; padding: 12px;">
                    <i class="fas fa-save"></i> CẬP NHẬT GÓI NẠP
                </button>
            </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const rechargeId = urlParams.get('id');
    
    if(rechargeId) {
        document.getElementById('editForm').style.display = 'block';
        document.getElementById('editForm').scrollIntoView({ behavior: 'smooth' });
    }
});
</script>

<?php
require_once("../../public/client/Footer.php");
?>