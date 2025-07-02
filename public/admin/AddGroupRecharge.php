<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
require_once("../../public/client/Header.php");
require_once("../../public/client/Nav.php");
CheckAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_recharge'])) {
        $group_id = check_string($_POST['group_id']);
        $title = check_string($_POST['title']);
        $money = check_string($_POST['money']);
        $display = check_string($_POST['display']);
        
        $CMSNT->insert("groups_napgame", [
            'groups' => $group_id,
            'title' => $title,
            'money' => $money,
            'display' => $display
        ]);
        msg_success2("Thêm gói nạp game thành công!", "", 2000);
    }
}

$category_napgame = $CMSNT->get_row("SELECT id FROM category WHERE title = 'DỊCH VỤ NẠP GAME'");
$groups_napgame = $CMSNT->get_list("SELECT * FROM groups WHERE category = '" . $category_napgame['id'] . "'");
?>
?>

<style>
    .note__title.add-header {
        color: #2a2a2a !important;
        font-size: 26px;
        font-weight: 700;
        text-align: center;
        text-shadow: none !important;
    }

    .add-form label {
        color: #000000 !important;
    }

    .add-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
    }

    .add-wrapper {
        width: 100%;
        max-width: 800px;
        background: rgba(255, 255, 255, 0.86);
        border-radius: 16px;
        box-shadow: 0 0 15px rgba(0,0,0,0.25);
        padding: 2rem;
    }

    .form-control {
        width: 100%;
        padding: 12px;
        color: #000;
        background-color: #fff;
        border-radius: 8px;
        border: 1px solid #ccc;
        margin-bottom: 1rem;
    }

    select.form-control {
        font-size: 15px;
        line-height: 1.4;
        padding: 10px 14px;
        height: auto;
        box-sizing: border-box;
        border-radius: 8px;
        border: 1px solid #ccc;
        color: #000;
        background-color: #fff;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg fill='%23333' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 10l5 5 5-5H7z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 16px;
    }

    .btn-pretty {
        background: #4CAF50;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        width: 100%;
        transition: all 0.3s;
        font-size: 16px;
        margin-top: 10px;
    }

    .btn-pretty:hover {
        background: #45a049;
    }
</style>

<div class="add-container">
    <div class="add-wrapper">
        <form method="POST" class="add-form">
            <h2 class="note__title add-header">➕ THÊM GÓI NẠP GAME</h2>
            <input type="hidden" name="add_recharge" value="1">

            <label class="menu-header">Chọn nhóm dịch vụ</label>
            <select name="group_id" class="form-control" required>
                <option value="">-- Chọn nhóm dịch vụ --</option>
                <?php foreach($groups_napgame as $group): ?>
                <option value="<?=$group['id'];?>"><?=$group['title'];?></option>
                <?php endforeach; ?>
            </select>

            <label class="menu-header">Tên gói nạp</label>
            <input type="text" name="title" class="form-control" placeholder="Ví dụ: Gói 100K" required>

            <label class="menu-header">Giá tiền (VNĐ)</label>
            <input type="number" name="money" class="form-control" placeholder="Ví dụ: 100000" required>

            <label class="menu-header">Trạng thái</label>
            <select name="display" class="form-control">
                <option value="SHOW">Hiển thị</option>
                <option value="HIDE">Ẩn</option>
            </select>

            <button type="submit" class="btn-pretty">Thêm Gói Nạp</button>
        </form>
    </div>
</div>

<?php
require_once("../../public/client/Footer.php");
?>