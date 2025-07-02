<?php
require_once(__DIR__."/../../config/config.php");
require_once(__DIR__."/../../config/function.php");
require_once("../../public/client/Header.php");
require_once("../../public/client/Nav.php");

CheckAdmin();

// Xử lý khi form được submit
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Kiểm tra xem có phải là yêu cầu cập nhật danh mục không
    if(isset($_POST['update_category'])) {
        $category_id = check_string($_POST['category_id']);
        $title = check_string($_POST['title']);
        $display = check_string($_POST['display']);
        $img = check_string($_POST['img']);
        
        // Validate dữ liệu
        if(empty($category_id) || empty($title)) {
            msg_error('Vui lòng nhập đầy đủ thông tin', '', 2000);
        }
        
        // Cập nhật vào database
        $update = $CMSNT->update("category", [
            'title' => $title,
            'display' => $display,
            'img' => $img
        ], "id = '$category_id'");
        
        if($update) {
            msg_success('Cập nhật danh mục thành công', BASE_URL('public/admin/UpdateCategory.php'), 2000);
        } else {
            msg_error('Cập nhật danh mục thất bại', '', 2000);
        }
    }
}

// Lấy danh sách danh mục từ database
$categories = $CMSNT->get_list("SELECT * FROM `category`");
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

    .category-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 2rem;
    }

    .category-table th, .category-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .category-table th {
        background-color: #f8f9fa;
        font-weight: 600;
    }

    .category-table tr:hover {
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

    .display-options {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .display-option {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
</style>

<div class="update-container">
    <div class="update-wrapper">
        <h2 class="update-header">CẬP NHẬT DANH MỤC</h2>
        
        <!-- Bảng hiển thị danh sách danh mục -->
        <table class="category-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên danh mục</th>
                    <th>Trạng thái</th>
                    <th>Ảnh</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($categories as $category): ?>
                <tr>
                    <td><?=$category['id']?></td>
                    <td><?=$category['title']?></td>
                    <td><?=display($category['display'])?></td>
                    <td>
                        <?php if(!empty($category['img'])): ?>
                            <img src="<?=$category['img']?>" style="max-width: 50px; max-height: 50px;">
                        <?php else: ?>
                            <span class="text-muted">Không có ảnh</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <button class="btn-update" onclick="openEditModal(
                            '<?=$category['id']?>',
                            '<?=$category['title']?>',
                            '<?=$category['display']?>',
                            '<?=$category['img']?>'
                        )">
                            <i class="fas fa-edit"></i> Sửa
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <!-- Form cập nhật (sẽ hiển thị trong modal) -->
        <div id="editModal" class="modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5);">
            <div class="modal-content" style="background-color: #fefefe; margin: 5% auto; padding: 20px; border: 1px solid #888; width: 50%; border-radius: 8px;">
                <span class="close" onclick="closeEditModal()" style="float: right; cursor: pointer; font-size: 24px;">&times;</span>
                
                <h3 style="margin-bottom: 20px;">Cập nhật danh mục</h3>
                
                <form method="POST">
                    <input type="hidden" name="category_id" id="edit_category_id">
                    
                    <div class="form-group">
                        <label>Tên danh mục</label>
                        <input type="text" name="title" id="edit_title" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Trạng thái hiển thị</label>
                        <div class="display-options">
                            <div class="display-option">
                                <input type="radio" name="display" id="display_show" value="SHOW" checked>
                                <label for="display_show">Hiển thị</label>
                            </div>
                            <div class="display-option">
                                <input type="radio" name="display" id="display_hide" value="HIDE">
                                <label for="display_hide">Ẩn</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Đường dẫn ảnh</label>
                        <input type="text" name="img" id="edit_img" class="form-control">
                    </div>
                    
                    <button type="submit" name="update_category" class="btn-update" style="width: 100%; padding: 12px;">
                        <i class="fas fa-save"></i> CẬP NHẬT
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Mở modal chỉnh sửa
    function openEditModal(id, title, display, img) {
        document.getElementById('editModal').style.display = 'block';
        document.getElementById('edit_category_id').value = id;
        document.getElementById('edit_title').value = title;
        document.getElementById('edit_img').value = img;
        
        // Set radio button
        if(display === 'HIDE') {
            document.getElementById('display_hide').checked = true;
        } else {
            document.getElementById('display_show').checked = true;
        }
    }
    
    // Đóng modal
    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }
    
    // Đóng modal khi click bên ngoài
    window.onclick = function(event) {
        const modal = document.getElementById('editModal');
        if(event.target == modal) {
            modal.style.display = 'none';
        }
    }
</script>

<?php
    require_once("../../public/client/Footer.php");
?>