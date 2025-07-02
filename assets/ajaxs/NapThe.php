<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");

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
        elseif ($obj['status'] == 99)
        {
            $CMSNT->insert("cards", array(
                'code' => $request_id,
                'seri' => $seri,
                'pin'  => $pin,
                'loaithe' => $loaithe,
                'menhgia' => $menhgia,
                'thucnhan' => '0',
                'username' => $getUser['username'],
                'status' => 'xuly',
                'note' => '',
                'createdate' => gettime()
            ));
            msg_success("Nạp thẻ thành công, đang chờ kết quả!", "", 5);
        }
        else
        {
            msg_error2("Hệ thống đang bảo trì!".$obj['message']);
        }