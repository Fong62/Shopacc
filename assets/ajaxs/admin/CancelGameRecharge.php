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

    $update = $CMSNT->update("order_napgame", [
        'status' => 'huy',
    ], " `id` = '$id' ");

    if($update)
    {
        msg_success("Đã hủy đơn hàng thành công", BASE_URL('public/admin/ConfirmGameRecharge.php'), 2000);
    }
    else
    {
        msg_error("Không thể hủy đơn hàng", BASE_URL('public/admin/ConfirmGameRecharge.php'), 2000);
    }
}
else
{
    msg_error("Thiếu dữ liệu", BASE_URL('public/admin/ConfirmGameRecharge.php'), 2000);
}