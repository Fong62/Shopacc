<?php
require_once("../../../config/config.php");
require_once("../../../config/function.php");

if(isset($_POST['id']))
{
    $username = check_string($_POST['id']);
    
    // 1. Lấy thông tin thẻ cào đang chờ xử lý của user
    $card = $CMSNT->get_row("SELECT * FROM `cards` WHERE `username` = '$username' AND `status` = 'xuly' ORDER BY id DESC LIMIT 1");
    if(!$card)
    {
        msg_error("Đơn hàng không tồn tại hoặc đã được xử lý", BASE_URL('public/admin/ConfirmRecharge.php'), 2000);
    }

    $update = $CMSNT->update("cards", [
        'status' => 'huy',
        'note' => 'Hủy bởi admin: '.$_SESSION['username'].' - '.gettime()
    ], " `id` = '".$card['id']."' ");

    if($update)
    {
        msg_success("Đã hủy thẻ cào thành công", BASE_URL('public/admin/ConfirmRecharge.php'), 2000);
    }
    else
    {
         msg_error("Không thể hủy thẻ cào", BASE_URL('public/admin/ConfirmRecharge.php'), 2000);
    }
}
else
{
    msg_error("Thiếu dữ liệu", BASE_URL('public/admin/ConfirmRecharge.php'), 2000);
}