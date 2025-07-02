<?php
$search_params = [
    'gia' => $_GET['gia'] ?? '',
    'sort' => $_GET['sort'] ?? '',
    'star5' => $_GET['star5'] ?? '',
    'acc_id' => $_GET['acc_id'] ?? ''
];
?>

<div class="col-lg-3 mb-4">
    <div class="p-3" style="background: #fdf3e6; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <h5 class="text-center mb-3">Tìm kiếm</h5>
        <form method="GET">
            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
            
            <div class="form-group mb-2">
                <label>Giá</label>
                <select name="gia" class="form-control">
                    <option value="">Chọn giá</option>
                    <option value="1" <?= $search_params['gia'] == '1' ? 'selected' : '' ?>>Dưới 100K</option>
                    <option value="2" <?= $search_params['gia'] == '2' ? 'selected' : '' ?>>100K - 300K</option>
                    <option value="3" <?= $search_params['gia'] == '3' ? 'selected' : '' ?>>Trên 300K</option>
                </select>
            </div>
            
            <div class="form-group mb-2">
                <label>Sắp xếp giá</label>
                <select name="sort" class="form-control">
                    <option value="" <?= empty($search_params['sort']) ? 'selected' : '' ?>>Mặc định</option> 
                    <option value="asc" <?= $search_params['sort'] == 'asc' ? 'selected' : '' ?>>Tăng dần</option>
                    <option value="desc" <?= $search_params['sort'] == 'desc' ? 'selected' : '' ?>>Giảm dần</option>
                </select>
            </div>
            
            <div class="form-group mb-2">
                <label>Nhân vật 5 sao</label>
                <input type="number" name="star5" class="form-control" 
                       placeholder="Số lượng" value="<?= htmlspecialchars($search_params['star5']) ?>">
            </div>
            
            <div class="form-group mb-3">
                <label>ID acc</label>
                <input type="number" name="acc_id" class="form-control" 
                       placeholder="Nhập ID" value="<?= htmlspecialchars($search_params['acc_id']) ?>">
            </div>
            
            <button type="submit" class="btn btn-warning w-100 fw-bold">🔍 Tìm kiếm</button>
            <?php if (!empty($_GET['gia']) || !empty($_GET['star5']) || !empty($_GET['acc_id'])): ?>
                <a href="Groups.php?id=<?= $_GET['id'] ?>" class="btn btn-outline-secondary w-100 mt-2">
                    Xóa bộ lọc
                </a>
            <?php endif; ?>
        </form>
    </div>
</div>