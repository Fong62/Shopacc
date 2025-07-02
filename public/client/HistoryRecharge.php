<?php
require_once(__DIR__."/../../config/config.php");
require_once(__DIR__."/../../config/function.php");
require_once(__DIR__. "/Header.php");
require_once(__DIR__. "/Nav.php");
?>

<style>
    .wrapper {
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    main {
        flex: 1;
    }

    .recharge-history {
        margin-top: 30px;
        background: rgba(27, 25, 60, 0.85);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.2);
    }

    .recharge-history h3 {
        color: #69e0ff;
        margin-bottom: 20px;
        font-size: 22px;
        text-align: center;
    }

    #datatable {
        width: 100%;
        color: #fff;
        border-collapse: collapse;
    }

    #datatable thead th {
        background-color: #b68967;
        color: white;
        font-weight: 600;
        border: none;
        padding: 12px 15px;
        text-align: center;
    }

    #datatable tbody td {
        border-color: rgba(182, 137, 103, 0.3);
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

    .badge-carrier {
        padding: 5px 10px;
        border-radius: 4px;
        font-weight: 600;
        background: #634827;
        color: white;
    }

    .badge-success {
        background-color: #28a745;
    }

    .badge-danger {
        background-color: #dc3545;
    }

    .badge-warning {
        background-color: #ffc107;
        color: #212529;
    }

    .badge-secondary {
        background-color: #6c757d;
    }

    .table-responsive {
        overflow-x: auto;
    }
</style>
<div class="wrapper">
    <main>
        <div class="recharge-history">
            <h3><i class="fas fa-history"></i> LỊCH SỬ NẠP THẺ</h3>
            <div class="table-responsive">
                <table id="datatable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Thời gian</th>
                            <th>Nhà mạng</th>
                            <th>Mệnh giá</th>
                            <th>Seri/Mã</th>
                            <th>Thực nhận</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $username = $getUser['username'];
                        $query = $CMSNT->get_list("SELECT * FROM `cards` WHERE `username` = '$username' ORDER BY id ASC");
                        
                        foreach($query as $row) {
                            $serial_display = substr($row['seri'], 0, 3).'...'.substr($row['seri'], -3);
                            $pin_display = substr($row['pin'], 0, 3).'...'.substr($row['pin'], -3);
                            
                            $status = status($row['status'])
                        ?>
                        <tr>
                            <td><?=$i++;?></td>
                            <td><?=date('d/m/Y H:i:s', strtotime($row['createdate']));?></td>
                            <td><span class="badge badge-carrier"><?=$row['loaithe'];?></span></td>
                            <td><?=format_cash($row['menhgia']);?> đ</td>
                            <td><?=$serial_display;?>/<?=$pin_display;?></td>
                            <td><?=format_cash($row['thucnhan']);?> đ</td>
                            <td><?=$status;?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<script>
$(document).ready(function() {
    $('#datatable').DataTable({
        "responsive": true,
        "autoWidth": false,
        "language": {
            "lengthMenu": "Hiển thị _MENU_ bản ghi mỗi trang",
            "zeroRecords": "Không tìm thấy bản ghi nào",
            "info": "Hiển thị trang _PAGE_ của _PAGES_",
            "infoEmpty": "Không có bản ghi nào",
            "infoFiltered": "(được lọc từ _MAX_ bản ghi)",
            "search": "Tìm kiếm:",
            "paginate": {
                "first": "Đầu",
                "last": "Cuối",
                "next": "Tiếp",
                "previous": "Trước"
            }
        }
    });
});
</script>

<?php
require_once(__DIR__ . "/Footer.php");
?>