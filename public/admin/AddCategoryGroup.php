<?php
require_once("../../config/config.php");
require_once("../../config/function.php");
require_once("../../public/client/Header.php");
require_once("../../public/client/Nav.php");
CheckAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_category'])) {
        $CMSNT->insert("category", [
            'title' => check_string($_POST['title']),
            'display' => $_POST['display'],
            'img' => '/assets/img/contentweb/2020031921140936446.png'
        ]);
        msg_success2("Thêm danh mục thành công!", "../../index.php");
    }

    if (isset($_POST['add_group'])) {
        $CMSNT->insert("groups", [
            'category' => $_POST['category'],
            'title' => check_string($_POST['title']),
            'display' => $_POST['display'],
            'img' => $_POST['img'],
            'chitiet' => $_POST['chitiet']
        ]);
        msg_success2("Thêm nhóm thành công!", "../../index.php");
    }
}
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

    .form-control {
        color: #000;
        background-color: #fff;
        border: 1px solid #ccc;
    }

    .add-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .add-wrapper {
        display: flex;
        width: 100%;
        max-width: 1000px;
        background: rgba(255, 255, 255, 0.86);
        border-radius: 16px;
        box-shadow: 0 0 15px rgba(0,0,0,0.25);
        overflow: hidden;
    }

    .add-form {
        flex: 1.2;
        padding: 2rem;
    }

    .add-form h2 {
        color: #ffffff;
        text-align: center;
        text-shadow: none;
        font-weight: 700;
        margin-bottom: 1.5rem;
    }

    .add-image {
        flex: 1;
        background-image: url('');
        background-size: contain;
        background-position: center;
        background-repeat: no-repeat;
        background-color: rgba(0, 0, 0, 0.15);
    }

    .form-control {
        width: 100%;
        padding: 20px;
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
        margin-top: 0.5rem;
    }
</style>

<div class="add-container">
    <div class="add-wrapper">
        <!-- Form thêm danh mục -->
        <form method="POST" class="add-form">
            <h2 class="note__title add-header">➕ THÊM DANH MỤC</h2>
            <input type="hidden" name="add_category" value="1">

            <label class="menu-header" for="title_category">Tên danh mục</label>
            <input id="title_category" name="title" class="form-control" placeholder="Tên danh mục" required>

            <label class="menu-header" for="display_category">Trạng thái</label>
            <select id="display_category" name="display" class="form-control">
                <option value="SHOW">Hiển thị</option>
                <option value="HIDE">Ẩn</option>
            </select>

            <button type="submit" class="btn-pretty mt-3">Thêm Danh Mục</button>
        </form>

        <!-- Form thêm groups-->
        <form method="POST" class="add-form">
            <h2 class="note__title add-header">➕ THÊM NHÓM</h2>
            <input type="hidden" name="add_group" value="1">

            <label class="menu-header" for="category_group">Chọn danh mục</label>
            <select id="category_group" name="category" class="form-control" required>
                <option value="">-- Chọn danh mục --</option>
                <?php foreach($CMSNT->get_list("SELECT * FROM category ORDER BY id ASC") as $cate): ?>
                    <option value="<?=$cate['id']?>"><?=$cate['title']?></option>
                <?php endforeach; ?>
            </select>

            <label class="menu-header" for="title_group">Tên nhóm</label>
            <input id="title_group" name="title" class="form-control" placeholder="Tên nhóm" required>

            <label class="menu-header" for="img_group">Link ảnh</label>
            <input id="img_group" name="img" class="form-control" placeholder="/images/group.jpg" required>

            <label class="menu-header" for="chitiet_group">Chi tiết</label>
            <textarea id="chitiet_group" name="chitiet" class="form-control" placeholder="Chi tiết nhóm (nếu có)"></textarea>

            <label class="menu-header" for="display_group">Trạng thái</label>
            <select id="display_group" name="display" class="form-control">
                <option value="SHOW">Hiển thị</option>
                <option value="HIDE">Ẩn</option>
            </select>

            <button type="submit" class="btn-pretty mt-3">Thêm Nhóm</button>
        </form>
    </div>
</div>
<?php
    require_once("../../public/client/Footer.php");
?>