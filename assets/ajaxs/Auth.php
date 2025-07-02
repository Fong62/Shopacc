<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");

    if($_POST['type'] == 'Login' )
    {
        $username = check_string($_POST['username']);
        $password = TypePassword(check_string($_POST['password']));
        if(empty($username))
        {
            msg_error2("Vui lòng nhập tên đăng nhập !");
        }
        if(!$CMSNT->get_row(" SELECT * FROM `users` WHERE `username` = '$username' "))
        {
            msg_error2('Tên đăng nhập không tồn tại');
        }
        if(empty($password))
        {
            msg_error2("Vui lòng nhập mật khẩu !");
        }
        if($CMSNT->get_row(" SELECT * FROM `users` WHERE `username` = '$username' AND `banned` = '1' "))
        {
            msg_error2('Tài khoản này đã bị khóa bởi BQT');
        }
        if(!$CMSNT->get_row(" SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '".md5($password)."' "))
        {
            msg_error2('Mật khẩu đăng nhập không chính xác');
        }
        $_SESSION['username'] = $username;
        msg_success('Đăng nhập thành công ', BASE_URL(''), 5);
    }
    

    if($_POST['type'] == 'Register' )
    {
        $username = check_string($_POST['username']);
        $password = check_string($_POST['password']);
        $email = check_string($_POST['email']);
        $repassword = check_string($_POST['repassword']);
        if(empty($username))
        {
            msg_error2("Vui lòng nhập tên tài khoản !");
        }
        if(check_username($username) != True)
        {
            msg_error2('Vui lòng nhập định dạng tài khoản hợp lệ');
        }
        if(strlen($username) < 5 || strlen($username) > 64)
        {
            msg_error2('Tài khoản phải từ 5 đến 64 ký tự');
        }
        if($CMSNT->get_row(" SELECT * FROM `users` WHERE `username` = '$username' "))
        {
            msg_error2('Tên đăng nhập đã tồn tại!');
        }
        if(empty($email)){
            msg_error2("Vui lòng nhập email !");
        }
        if(empty($password))
        {
            msg_error2("Vui lòng nhập mật khẩu !");
        }
        if(strlen($password) < 3)
        {
            msg_error2('Vui lòng đặt mật khẩu 3 ký tự trở lên');
        }
        if($password != $repassword)
        {
            msg_error2('Nhập lại mật khẩu không đúng');
        }
        $create = $CMSNT->insert("users", [
            'username'      => $username,
            'password'      => TypePassword(md5($password)),
            'token'         => random('qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM', 64),
            'money'         => 0,
            'total_money'   => 0,
            'banned'        => 0,
            'createdate'    => gettime(),
            'email'         => $email
        ]);
        if ($create)
        { 
            //$_SESSION['username'] = $username;
            msg_success('Đăng ký thành công ', BASE_URL(''), 5);
        }
        else
        {
            msg_error2('Vui lòng kiểm tra cấu hình DATABASE');
        }
    }

    if ($_POST['type'] == 'NapThe'){
        $loaithe = check_string($_POST['loaithe']);
        $menhgia = check_string($_POST['menhgia']);
        $seri = check_string($_POST['seri']);
        $pin = check_string($_POST['pin']);
    
        if(empty($_SESSION['username']))
        {
            msg_error("Vui lòng đăng nhập ", BASE_URL(''), 2000);
        }
        if(empty($loaithe))
        {
            msg_error2("Vui lòng chọn loại thẻ");
        }
        if(empty($menhgia))
        {
            msg_error2("Vui lòng chọn mệnh giá");
        }
        if(empty($seri))
        {
            msg_error2("Vui lòng nhập seri thẻ");
        }
        if(empty($pin))
        {
            msg_error2("Vui lòng nhập mã thẻ");
        }
        if (strlen($seri) < 5 || strlen($pin) < 5)
        {
            msg_error2("Mã thẻ hoặc seri không đúng định dạng!");
        }
        $CMSNT->insert("cards", array(
            'code' => $request_id,
            'seri' => $seri,
            'pin'  => $pin,
            'loaithe' => $loaithe,
            'menhgia' => $menhgia,
            'thucnhan' => $menhgia,
            'username' => $getUser['username'],
            'status' => 'xuly',
            'note' => '',
            'createdate' => gettime()
        ));
        msg_success("Nạp thẻ thành công. Vui lòng đợi trong giây lát để hệ thống xác nhận giao dịch.", "", 5);
    }

    if($_POST['type'] == 'ChangePass')
    {
        
        $repassword = check_string($_POST['repassword']);
        $password = check_string($_POST['password']);
        if(empty($password))
        {
            msg_error2("Bạn chưa nhập mật khẩu mới");
        }
        if(empty($repassword))
        {
            msg_error2("Vui lòng xác minh lại mật khẩu");
        }
        if($password != $repassword)
        {
            msg_error2("Nhập lại mật khẩu không đúng");
        }
        if(strlen($password) < 5)
        {
            msg_error2('Vui lòng nhập mật khẩu có ích nhất 5 ký tự');
        }
        $row = $CMSNT->get_row(" SELECT * FROM `users` WHERE `username` = '".$_SESSION['username']."' ");
        if(!$row)
        {
            msg_error("Vui lòng đăng nhập!", BASE_URL(''),5);
        }
        $CMSNT->update("users", [
            'password' => TypePassword(md5($password))
        ], " `id` = '".$row['id']."' ");
        session_destroy();
        msg_success("Mật khẩu của bạn đã được thay đổi thành công! Vui lòng đăng nhập lại", BASE_URL(''), 5);
        
        
    }
    if ($_POST['type'] == 'Ban') {
         $id = check_string($_POST['id']);

        if (empty($id)) {
            msg_error2("Thiếu id người dùng.");
        }

        
        $row = $CMSNT->get_row("SELECT * FROM `users` WHERE `id` = '{$id}' ");
        if (!$row) {
            msg_error2("Không tìm thấy người dùng.");
        }
        $CMSNT->update("users", ['banned' => 1], " `id` = '{$id}' ");
        msg_success("Đã ban tài khoản {$row['username']}.","",5);
    }

    if ($_POST['type'] == 'Unban') {
         $id = check_string($_POST['id']);

        if (empty($id)) {
            msg_error2("Thiếu id người dùng.");
        }

       
        $row = $CMSNT->get_row("SELECT * FROM `users` WHERE `id` = '{$id}' ");
        if (!$row) {
            msg_error2("Không tìm thấy người dùng.");
        }
        $CMSNT->update("users", ['banned' => 0], " `id` = '{$id}' ");
        msg_success("Đã bỏ ban tài khoản {$row['username']}.","",5);
    }

    if($_POST['type'] == 'buy_account') {
        if(!isset($_SESSION['username'])) {
            msg_error2("Vui lòng đăng nhập để thực hiện mua hàng");
        }
        
        $id = check_string($_POST['id']);
        $account = $CMSNT->get_row("SELECT * FROM `accounts` WHERE `id` = '$id'");
        if(!$account) {
            msg_error2("Tài khoản không tồn tại");
        }
        if($account['status'] != 'Chưa bán') {
            msg_error2("Tài khoản này đã được bán");
        }
        
        $user = $CMSNT->get_row("SELECT * FROM `users` WHERE `username` = '".$_SESSION['username']."' ");
        if($user['money'] < $account['money']) {
            msg_error2("Số dư không đủ để mua tài khoản này");
        }
        
        $group = $CMSNT->get_row("SELECT * FROM `groups` WHERE `id` = '".$account['groups']."'");
        // Ghi log giao dịch
        $CMSNT->insert("dongtien", array(
            'sotientruoc' => $user['money'],
            'sotienthaydoi' => '-'.$account['money'],
            'sotiensau' => $user['money'] - $account['money'],
            'thoigian' => gettime(),
            'noidung' => 'Mua tài khoản #'.$account['id'],
            'username' => $_SESSION['username']
        ));

        $CMSNT->tru("users", "money", $account['money'], "username = '".$_SESSION['username']."'");

        $admin = $CMSNT->get_row("SELECT * FROM `users` WHERE `level` = 'admin' AND username = 'huybeo'");
            $CMSNT->insert("dongtien", [
                'sotientruoc' => $admin['money'],
                'sotienthaydoi' => $account['money'],
                'sotiensau' => $admin['money'] + $account['money'],
                'thoigian' => gettime(),
                'noidung' => 'Nhận tiền từ mua tài khoản #'.$account['id'],
                'username' => $admin['username']
            ]);

        $CMSNT->cong("users", "money", $account['money'], "level = 'admin' AND username = 'huybeo'");
        $CMSNT->cong("users", "total_money", $account['money'], "level = 'admin' AND username = 'huybeo'");

        list($account_username, $account_password) = explode(',', $account['account']);
        // Tạo đơn hàng
        $CMSNT->insert("order_account", array(
            'username' => $_SESSION['username'],
            'category' => $group['category'],
            'groups' => $account['groups'],
            'account_username' => $account_username,
            'account_password' => $account_password,
            'money' => $account['money'],
            'status' => 'hoanthanh',
            'created_at' => gettime(),
            'chitiet' => 'Mua tài khoản #'.$account['id']
        ));
        
        // Cập nhật trạng thái tài khoản
        $CMSNT->update("accounts", array(
            'status' => 'Đã bán',
            'username' => $_SESSION['username'],
            'updatedate' => gettime()
        ), "id = '$id'");
        
        msg_success2("Mua tài khoản thành công", BASE_URL('public/client/HistoryAccount.php'), 2000);
    }

        
    