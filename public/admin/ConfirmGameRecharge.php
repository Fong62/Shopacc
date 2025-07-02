<?php 
require_once("../../config/config.php");
require_once("../../config/function.php");
$title = 'XÁC NHẬN NẠP GAME | '.$CMSNT->site('tenweb');
require_once("../../public/client/Header.php");
require_once("../../public/client/Nav.php");
CheckAdmin();
?>

<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
    }

    .wrapper {
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    main {
        flex: 1;
    }
    
    /* Nền tổng thể và font chữ */
    body {
        background-color: #1e1e2d;
        color: #ffffff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Container chính */
    .table-responsive {
        background-color: #2a2a3c;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        margin: 20px 0;
    }

    #datatable {
        width: 100% !important;
        color: #fff;
    }

    #datatable thead th {
        background-color: #b68967;
        color: white;
        font-weight: 600;
        border: none !important;
        padding: 12px 15px;
        text-align: center;
    }

    #datatable tbody td {
        border-color: rgba(182, 137, 103, 0.3) !important;
        padding: 10px 15px;
        vertical-align: middle;
        text-align: center;
    }

    #datatable tbody tr:nth-child(even) {
        background-color: rgba(182, 137, 103, 0.1);
    }

    #datatable tbody tr:hover {
        background-color: rgba(182, 137, 103, 0.2);
    }

    /* Badge */
    .badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-weight: 500;
        font-size: 12px;
    }

    .badge-danger {
        background-color: #ff4757;
        color: white;
    }

    .badge-dark {
        background-color: #57606f;
        color: white;
    }

    .badge-success {
        background-color: #28a745;
        color: white;
    }

    .badge-warning {
        background-color: #ffc107;
        color: #212529;
    }

    /* Nút xác nhận */
    .btn-confirm {
        background: linear-gradient(135deg, #00b09b, #96c93d);
        border: none;
        border-radius: 25px;
        padding: 8px 15px;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        font-size: 12px;
    }

    .btn-confirm:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        background: linear-gradient(135deg, #00b09b, #96c93d);
    }

    .btn-confirm:disabled {
        opacity: 0.7;
        transform: none !important;
    }

    .btn-cancel {
        background: linear-gradient(135deg, #ff416c, #ff4b2b);
        border: none;
        border-radius: 25px;
        padding: 8px 15px;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        font-size: 12px;
    }

    .btn-cancel:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        background: linear-gradient(135deg, #ff416c, #ff4b2b);
    }
</style>

<div class="wrapper">
    <main>
        <div id="thongbao" class="text-sm text-red-500 mb-3"></div>

        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-hover table-sm text-center align-middle">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>USERNAME</th>
                        <th>DỊCH VỤ</th>
                        <th>UID/ID</th>
                        <th>THÔNG TIN</th>
                        <th>SỐ TIỀN</th>
                        <th>THỜI GIAN</th>
                        <th>TRẠNG THÁI</th>
                        <th>GHI CHÚ</th>
                        <th>XÁC NHẬN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 1;
                        foreach($CMSNT->get_list("SELECT o.*, g.title AS game_title 
                            FROM `order_napgame` o 
                            LEFT JOIN `groups` g ON o.groups = g.id 
                            WHERE o.`status` = 'xuly' 
                            ORDER BY o.id ASC") as $row) {
                    ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $row['username']; ?></td>
                        <td><?= $row['game_title']; ?></td>
                        <td><?= $row['uid'] ?: $row['character_name']; ?></td>
                        <td>
                            <?php if($row['login_username']): ?>
                                User: <?= $row['login_username']; ?><br>
                            <?php endif; ?>
                            <?php if($row['login_password']): ?>
                                Pass: <?= $row['login_password']; ?><br>
                            <?php endif; ?>
                            <?php if($row['server']): ?>
                                Server: <?= $row['server']; ?><br>
                            <?php endif; ?>
                            <?php if($row['phone']): ?>
                                Phone: <?= $row['phone']; ?>
                            <?php endif; ?>
                        </td>
                        <td><?= format_cash($row['money']); ?>đ</td>
                        <td><span class="badge badge-dark"><?= $row['created_at']; ?></span></td>
                        <td><?= status($row['status']); ?></td>
                        <td><?= $row['note']; ?></td>
                        <td>
                            <button type="button" class="btn btn-success btn-confirm" 
                                data-id="<?= $row['id']; ?>" 
                                style="font-weight: bold; font-size: 13px;">
                                Xác nhận
                            </button>
                             <button type="button" class="btn btn-danger btn-cancel mt-1" 
                                data-id="<?= $row['id']; ?>"
                                style="font-weight: bold; font-size: 13px;">
                                Hủy
                            </button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
</div>

<script type="text/javascript">
    $('.btn-confirm').click(function() {
        var button = $(this);
        var order_id = button.data('id');
        
        button.html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý...').prop('disabled', true);

        $.ajax({
            url: "<?=BASE_URL('assets/ajaxs/admin/ConfirmGameRecharge.php');?>",
            method: "POST",
            data: {
                id: order_id
            },
            success: function(response) {
                $("#thongbao").html(response);
                button.html('Xác nhận').prop('disabled', false);
            }
        });
    });

    $('.btn-cancel').click(function() {
        var button = $(this);
        var order_id = button.data('id');
        
        Swal.fire({
            title: 'Xác nhận hủy đơn hàng?',
            text: "Bạn có chắc muốn hủy đơn hàng này?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Đồng ý hủy',
            cancelButtonText: 'Không hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                button.html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý...').prop('disabled', true);

                $.ajax({
                    url: "<?=BASE_URL('assets/ajaxs/admin/CancelGameRecharge.php');?>",
                    method: "POST",
                    data: {
                        id: order_id
                    },
                    success: function(response) {
                        $("#thongbao").html(response);
                        button.html('Hủy').prop('disabled', false);
                    }
                });
            }
        });
    });
    
</script>

<?php 
require_once("../../public/client/Footer.php");
?>