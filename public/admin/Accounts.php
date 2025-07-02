<?php
require_once(__DIR__."/../../config/config.php");
require_once(__DIR__."/../../config/function.php");

require_once("../../public/client/Header.php");
require_once("../../public/client/Nav.php");
CheckAdmin();

// Lấy thông tin tìm kiếm và phân trang
$username = isset($_GET['id']) ? check_string($_GET['id']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 2;
$start = ($page - 1) * $limit;

$list = [];
$total = 0;

if(empty($username)) {
    $total = $CMSNT->num_rows("SELECT * FROM users");
    $list = $CMSNT->get_list("
        SELECT id, username, email, level, createdate, banned 
        FROM users 
        
        LIMIT $start, $limit
    ");
} else {
    $total = $CMSNT->num_rows("SELECT * FROM users WHERE username = '{$username}'");
    $list = $CMSNT->get_list("
        SELECT id, username, email, level, createdate, banned
        FROM users 
        WHERE username = '{$username}' 
        
        LIMIT $start, $limit
    ");
}

$totalPages = ceil($total / $limit);
?>

<div class="container mt-4">
    <h2 class="text-white">Tìm kiếm tài khoản</h2>
    <div id="thongbao" class="text-sm text-red-500 mb-3"></div>
    <!-- Form tìm kiếm -->
    <form class="form-inline mb-4" action="/public/admin/Accounts.php" method="get">
        <div class="form-group mr-2">
            <input 
                type="text" 
                name="id" 
                class="form-control" 
                placeholder="Nhập username..." 
                value="<?= htmlspecialchars($username) ?>"
            >
        </div>
        <button type="submit" class="btn btn-primary">Tìm</button>
    </form>

    <?php if (!empty($list)): ?>
        <?php foreach($list as $user): ?>
            <!-- Thẻ hiển thị thông tin user -->
            <div class="card mb-3">
                <div class="card-header">
                    Thông tin user: <strong><?= htmlspecialchars($user['username']) ?></strong>
                </div>
                <div class="card-body">
                    <p><strong>ID:</strong> <?= $user['id'] ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
                    <p><strong>Level:</strong> <?= ucfirst($user['level']) ?></p>
                    <p><strong>Ngày tạo:</strong> <?= format_date(strtotime($user['createdate'])) ?></p>
                    <?php if ($user['username'] != $_SESSION['username']): ?>
                        <button class="btn <?= $user['banned'] == 1 ? 'btn-success' : 'btn-danger' ?> BanUserBtn" data-id="<?= $user['id'] ?>" data-banned="<?= $user['banned'] ?>">
                            <?= $user['banned'] == 1 ? 'Bỏ ban' : 'Ban' ?>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- Phân trang -->
        <?php if ($totalPages > 1): ?>
            <nav>
                <ul class="pagination">
                    <?php for($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                            <a class="page-link" href="?id=<?= urlencode($username) ?>&page=<?= $i ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
        
        <a href="Accounts.php" class="btn btn-secondary">Quay lại</a>
    <?php else: ?>
        <div class="alert alert-warning">
            Không tìm thấy tài khoản <strong><?= htmlspecialchars($username) ?></strong>.
        </div>
    <?php endif; ?>
</div>

<script type="text/javascript">
    $(document).on("click", ".BanUserBtn", function () {
        var btn = $(this);
        var id = btn.data("id");
        var currentStatus = btn.data("banned");

        btn.html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý...').prop('disabled', true);

        $.ajax({
            url: "<?=BASE_URL('assets/ajaxs/Auth.php');?>",
            method: "POST",
            data: {
                type: currentStatus == 1 ? 'Unban' : 'Ban',
                id: id
             },
             success: function (response) {
            $("#thongbao").html(response);

            
            if (currentStatus == 1) {
                btn.removeClass("btn-success").addClass("btn-danger");
                btn.html("Ban");
                btn.data("banned", 0);
            } else {
                btn.removeClass("btn-danger").addClass("btn-success");
                btn.html("Bỏ ban");
                btn.data("banned", 1);
            }

            btn.prop('disabled', false);
        }
        });
    });
</script>

<?php
require_once("../../public/client/Footer.php");
?>
