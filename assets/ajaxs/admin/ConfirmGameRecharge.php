<?php
require_once("../../../config/config.php");
require_once("../../../config/function.php");

if(isset($_POST['id']))
{
    $id = check_string($_POST['id']);
    
    $order = $CMSNT->get_row("SELECT * FROM `order_napgame` WHERE `id` = '$id' AND `status` = 'xuly' ");
    if(!$order)
    {
        msg_error("Đơn hàng không tồn tại hoặc đã được xử lý", BASE_URL('public/admin/ConfirmGameRecharge.php'), 2000);
    }

    $user = $CMSNT->get_row("SELECT * FROM `users` WHERE `username` = '".$order['username']."' ");
    if(!$user)
    {
        msg_error("Người dùng không tồn tại", BASE_URL('public/admin/ConfirmGameRecharge.php'), 2000);
    }

    if($user['money'] < $order['money'])
    {
        msg_error("Người dùng không đủ tiền", BASE_URL('public/admin/ConfirmGameRecharge.php'), 2000);
    }

    $CMSNT->update("order_napgame", [
        'status' => 'hoanthanh',
    ], " `id` = '$id' ");

    $CMSNT->tru("users", "money", $order['money'], " `username` = '".$order['username']."' ");

    $CMSNT->cong("users", "money", $order['money'], "level = 'admin' AND username = 'huybeo'");
    $CMSNT->cong("users", "total_money", $order['money'], "level = 'admin' AND username = 'huybeo'");

    $CMSNT->insert("dongtien", [
        'sotientruoc' => $user['money'],
        'sotienthaydoi' => -$order['money'],
        'sotiensau' => $user['money'] - $order['money'],
        'thoigian' => gettime(),
        'noidung' => 'Thanh toán đơn nạp game #'.$id,
        'username' => $order['username']
    ]);

    $admin = $CMSNT->get_row("SELECT * FROM `users` WHERE `level` = 'admin' AND username = 'huybeo'");
    $CMSNT->insert("dongtien", [
        'sotientruoc' => $admin['money'],
        'sotienthaydoi' => $order['money'],
        'sotiensau' => $admin['money'] + $order['money'],
        'thoigian' => gettime(),
        'noidung' => 'Nhận tiền từ đơn nạp game #'.$id,
        'username' => $admin['username']
    ]);

    msg_success("Xác nhận đơn hàng thành công", BASE_URL('public/admin/ConfirmGameRecharge.php'), 2000);
}
else
{
    msg_error("Thiếu dữ liệu", BASE_URL('public/admin/ConfirmGameRecharge.php'), 2000);
}