<?php
require_once(__DIR__."/../../config/config.php");
require_once(__DIR__."/../../config/function.php");
require_once(__DIR__. "/Header.php");
require_once(__DIR__. "/Nav.php");

if(!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$group = $CMSNT->get_row("SELECT * FROM groups WHERE id = '".check_string($_GET['id'])."'");
if(!$group) {
    header("Location: index.php");
    exit();
}

$category = $CMSNT->get_row("SELECT * FROM category WHERE id = '".$group['category']."'");

// Thiết lập phân trang
$per_page = 18; // Số tài khoản mỗi trang
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1; // Trang hiện tại
$start = ($page - 1) * $per_page; // Vị trí bắt đầu

// Xây dựng câu truy vấn với các điều kiện tìm kiếm
$query = "SELECT * FROM accounts WHERE groups = '".$group['id']."' AND status = 'Chưa bán'";

// Thêm điều kiện tìm kiếm theo giá
if(isset($_GET['gia'])) {
    switch($_GET['gia']) {
        case '1': $query .= " AND money < 100000"; break;
        case '2': $query .= " AND money BETWEEN 100000 AND 300000"; break;
        case '3': $query .= " AND money > 300000"; break;
    }
}

// Thêm điều kiện tìm kiếm theo số sao 5
if(!empty($_GET['star5']) && is_numeric($_GET['star5'])) {
    $query .= " AND fivestar >= ".intval($_GET['star5']);
}

// Thêm điều kiện tìm kiếm theo ID
if(!empty($_GET['acc_id']) && is_numeric($_GET['acc_id'])) {
    $query .= " AND id = ".intval($_GET['acc_id']);
}

// Thêm sắp xếp
if (!empty($_GET['sort']) && in_array($_GET['sort'], ['asc', 'desc'])) {
    $query .= " ORDER BY money ".$_GET['sort'];
} else {
    $query .= " ORDER BY id ASC";
}

// Lấy tổng số tài khoản (không phân trang)
$total_query = str_replace('SELECT *', 'SELECT COUNT(*) as total', $query);
$total_result = $CMSNT->get_row($total_query);
$total_accounts = $total_result['total'];

// Thêm giới hạn phân trang vào câu truy vấn chính
$query .= " LIMIT $start, $per_page";

$accounts = $CMSNT->get_list($query);
?>

<!-- <?php if (isset($_SESSION['username']) && $my_level == 'admin'): ?>
    <span class="mt-2 right">
        <a href="/public/admin/AddAccounts.php">
            <button class="btn-pretty" style="position: absolute;right: 0px;">Thêm tài khoản
            </button>
        </a>
    </span>
<?php endif; ?> -->

<center>
    <img src="../../<?= $category['img'] ?>" class="city__icon">
</center>
<h1 class="guide__title"><?= $group['title'] ?></h1>

<div class="container">
    <div class="row">
        <!-- Include sidebar -->
        <?php include(__DIR__.'/Sidebar.php'); ?>
        
        <!-- Danh sách tài khoản -->
        <div class="col-lg-9">
            <?php if(empty($accounts)): ?>
                <div class="text-center py-4" style="font-size: 1.2rem; background-color: rgba(0,0,0,0.5); border-radius: 10px; color: white; padding: 2rem; margin: 2rem 0;">
                    <i class="fas fa-exclamation-triangle fa-2x mb-3" style="color: #ffc107;"></i><br>
                    <strong style="font-size: 1.5rem;">KHÔNG TÌM THẤY TÀI KHOẢN!</strong><br>
                    <a href="Groups.php?id=<?= $_GET['id'] ?>" class="btn btn-outline-warning mt-3" style="font-size: 1.1rem; padding: 0.5rem 2rem;">
                        BỎ LỌC TÌM KIẾM
                    </a>
                </div>
            <?php else: ?>
                <div class="row">
                    <?php foreach($accounts as $account): ?>
                    <article class="col-lg-4 col-sm-6 col-6">
                        <div class="genshin-product">
                            <div class="wrapper product-wrapper">
                                <a href="#">
                                    <img class="img-banner" src="<?= htmlspecialchars($account['img'] ?? '/assets/img/default-banner.jpg') ?>" alt="acc-img">
                                </a>
                                <div class="product-code"><?= $account['id'] ?></div>
                                
                                <!-- Phần chi tiết -->
                                <div class="row g-0 info-line">
                                    <section class="row g-0">
                                        <label class="text-muted" style="font-size: 20px;">Chi tiết</label>
                                        <span class="more-detail fw-bold" style="font-size: 16px;"><?= $account['chitiet'] ?></span>
                                    </section>
                                </div>

                                <hr class="mb-1">
                                
                                <!-- Phần level và server -->
                                <div class="row g-0 info-line">
                                    <section class="col-6 text-left">
                                        <label class="text-muted" style="font-size: 14px;">Level</label>
                                        <span class="more-detail text-danger" style="font-size: 16px;"><?= $account['level'] ?></span>
                                    </section>
                                    <section class="col-6 text-right">
                                        <label class="text-muted" style="font-size: 14px;">Server</label>
                                        <span class="more-detail text-danger" style="font-size: 18px;"><?= $account['server'] ?></span>
                                    </section>
                                </div>
                                
                                <hr class="mb-1">
                                
                                <!-- Phần mã account và giá -->
                                <div class="row g-0 info-line">
                                    <section class="col-6 text-left">
                                        <label class="text-muted" style="font-size: 16px;">Mã account</label>
                                        <span class="more-detail text-danger" style="font-size: 18px;"><?= $account['id'] ?></span>
                                    </section>
                                    <section class="col-6 text-right">
                                        <label class="text-muted" style="font-size: 16px;">Giá</label>
                                        <span class="more-detail text-danger fw-bold" style="font-size: 18px;"><?= number_format($account['money']) ?>đ</span>
                                    </section>
                                </div>
                                
                                <div class="genshin-product-footer">
                                    <div class="hr-product mt-1 mb-1"></div>
                                    <div class="row g-0 info-line">
                                        <section class="col-6 text-center">
                                            <label class="text-muted" style="font-size: 16px;">Nhân vật 5 sao</label>
                                            <span class="more-detail text-danger fw-bold" style="font-size: 18px;"><?= number_format($account['fivestar'])?></span>
                                        </section>
                                    </div>
                                    <a href="/public/client/Account.php?id=<?=$account['id']?>">
                                        <button class="btn-pretty mb-2">Xem chi tiết</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>
                
                <!-- Hiển thị thanh phân trang -->
                <div class="row mt-4">
                    <div class="col-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                <?php
                                $total_pages = ceil($total_accounts / $per_page);
                                $current_url = "Groups.php?id=".$_GET['id'];
                                
                                // Thêm các tham số filter vào URL phân trang
                                $query_params = ['gia', 'star5', 'acc_id', 'sort'];
                                foreach($query_params as $param) {
                                    if(isset($_GET[$param])) {
                                        $current_url .= "&$param=".$_GET[$param];
                                    }
                                }
                                
                                // Số trang hiển thị tối đa
                                $max_visible_pages = 5;
                                
                                // Tính toán phạm vi trang hiển thị
                                $start_page = max(1, min($page - floor($max_visible_pages/2), $total_pages - $max_visible_pages + 1));
                                $end_page = min($total_pages, $start_page + $max_visible_pages - 1);
                                
                                // Nút trang đầu tiên
                                if($start_page > 1): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?= $current_url.'&page=1' ?>">1</a>
                                    </li>
                                    <?php if($start_page > 2): ?>
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#">...</a>
                                        </li>
                                    <?php endif;
                                endif;
                                
                                // Nút trang trước (mũi tên trái)
                                if($page > 1): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?= $current_url.'&page='.($page - 1) ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                <?php endif;
                                
                                // Hiển thị các trang trong phạm vi
                                for($i = $start_page; $i <= $end_page; $i++): ?>
                                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                        <a class="page-link" href="<?= $current_url.'&page='.$i ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor;
                                
                                // Nút trang sau (mũi tên phải)
                                if($page < $total_pages): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?= $current_url.'&page='.($page + 1) ?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                <?php endif;
                                
                                // Nút trang cuối cùng
                                if($end_page < $total_pages): ?>
                                    <?php if($end_page < $total_pages - 1): ?>
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#">...</a>
                                        </li>
                                    <?php endif; ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?= $current_url.'&page='.$total_pages ?>"><?= $total_pages ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
require_once(__DIR__ . "/Footer.php");
?>