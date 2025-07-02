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
            <h3><i class="fas fa-coins"></i> LỊCH SỬ NẠP GAME</h3>
            <div class="table-responsive">
                <table id="datatable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Thời gian</th>
                            <th>Dịch vụ</th>
                            <th>Số tiền</th>
                            <th>Mã GD</th>
                            <th>Trạng thái</th>
                            <th>Ghi chú</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $username = $getUser['username'];
                        $query = $CMSNT->get_list("
                            SELECT o.*, g.title AS group_title 
                            FROM `order_napgame` o
                            LEFT JOIN `groups` g ON o.groups = g.id
                            WHERE o.`username` = '$username' 
                            ORDER BY o.id ASC
                        ");
                        
                        foreach($query as $row) {
                            // Format transaction ID
                            $id = 'GD'.str_pad($row['id'], 3, '0', STR_PAD_LEFT);
                            
                            // Format status
                            $status = status($row['status'])
                           
                        ?>
                        <tr>
                            <td><?=$i++;?></td>
                            <td><?=date('d/m/Y H:i:s', strtotime($row['created_at']))?></td>
                            <td><span class="badge badge-carrier"><?=$row['group_title']?></span></td>
                            <td><?=format_cash($row['money'])?> đ</td>
                            <td><?=$id?></td>
                            <td><?=$status?></td>
                            <td><?=($row['note'])?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<?php
require_once(__DIR__ . "/Footer.php");
?>