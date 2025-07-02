<?php
require_once("../../../config/config.php");
require_once("../../../config/function.php");

if (isset($_POST['username'])) {
    $username = check_string($_POST['username']);
    $row = $CMSNT->get_row("SELECT * FROM `cards` WHERE `username` = '$username' AND `status` = 'xuly' ");

    if ($row) { // Phải kiểm tra $row trước
        $thucnhan = $row['menhgia'];

        /* CẬP NHẬT TRẠNG THÁI THẺ CÀO */
        $CMSNT->update("cards", [
            'status'    => 'hoanthanh',
            'thucnhan'  => $thucnhan
        ], " `id` = '".$row['id']."' ");

        $row_user = $CMSNT->get_row("SELECT * FROM `users` WHERE `username` = '$username' ");
        if ($row_user) {
            /* CỘNG TIỀN USER */
            $CMSNT->cong("users", "money", $thucnhan, " `id` = '".$row_user['id']."' ");
            $CMSNT->cong("users", "total_money", $thucnhan, " `id` = '".$row_user['id']."' ");

            /* GHI LOG DÒNG TIỀN */
            $create = $CMSNT->insert("dongtien", [
                'sotientruoc' => $row_user['money'] ,
                'sotienthaydoi' => $thucnhan,
                'sotiensau' => $row_user['money'] + $thucnhan,
                'thoigian' => gettime(),
                'noidung' => 'Nạp tiền thẻ cào seri ('.$row['seri'].')',
                'username' => $row_user['username']
            ]);

            if ($create) {
                msg_success('Success', BASE_URL('public/admin/ConfirmRecharge.php'), 5);
            } else {
                msg_error2('Vui lòng kiểm tra cấu hình DATABASE');
            }
        } else {
            msg_error2('Không tìm thấy người dùng!');
        }
    } else {
        msg_error2('Không tìm thấy thẻ đang xử lý!');
    }
} else {
    msg_error2('Thiếu dữ liệu username!');
}
?>