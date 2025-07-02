<?php
require_once(__DIR__."/../../../config/config.php");
require_once(__DIR__."/../../../config/function.php");

if ($_POST['type'] == 'AddMoney' ) {
    $admin = AboutMe();
    if (!$admin || $admin['level'] != 'admin') {
        msg_error("Bạn không có quyền thực hiện thao tác này", BASE_URL('public/admin/AddMoneyUser.php'), 2000);
    }

    $username = check_string($_POST['username']);
    $amount = check_string($_POST['amount']);
    $note = check_string($_POST['note']);

    if (empty($username)) {
        msg_error("Vui lòng chọn user", BASE_URL('public/admin/AddMoneyUser.php'), 2000);
    }

    if (!is_numeric($amount) || $amount <= 0) {
        msg_error("Số tiền phải là số dương", BASE_URL('public/admin/AddMoneyUser.php'), 2000);
    }

    $user = $CMSNT->get_row("SELECT * FROM `users` WHERE `username` = '$username'");
    if (!$user) {
        msg_error("User không tồn tại", BASE_URL('public/admin/AddMoneyUser.php'), 2000);
    }

    $CMSNT->insert("dongtien", [
        'sotientruoc' => $user['money'],
        'sotienthaydoi' => $amount,
        'sotiensau' => $user['money'] + $amount,
        'thoigian' => gettime(),
        'noidung' => $note.' (Admin: '.$admin['username'].')',
        'username' => $username
    ]);
    
    $CMSNT->cong("users", "money", $amount, " `username` = '$username'");

    $CMSNT->cong("users", "total_money", $amount, " `username` = '$username'");

    msg_success('Đã cộng '.format_cash($amount).'đ cho user '.$username.' thành công', BASE_URL('public/admin/AddMoneyUser.php'), 2000);
}
else
{
    msg_error("Thiếu dữ liệu", BASE_URL('public/admin/AddMoneyUser.php'), 2000);
}