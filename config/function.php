<?php
$CMSNT = new CMSNT;

$config = [
    'project'   => 'SHOPGAME',
    'version'   => '1.0.0'
];
function BASE_URL($url)
{
    $a = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"];
    if($a == 'http://localhost'){
        $a = '';
    }
    return $a.'/'.$url;
}

function getUser($username, $row)
{
    global $CMSNT;
    return $CMSNT->get_row("SELECT * FROM `users` WHERE `username` = '$username' ")[$row];
}

function insert_options($name, $value)
{
    global $CMSNT;
    if(!$CMSNT->get_row("SELECT * FROM `options` WHERE `name` = '$name' "))
    {
        $CMSNT->insert("options", [
            'name'  => $name,
            'value' => $value
        ]);
    }
}
function format_date($time){
    return date("H:i:s d/m/Y", $time);
}

function gettime()
{
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    return date('Y/m/d H:i:s', time());
}
function check_string($data)
{
    return trim(htmlspecialchars(addslashes($data)));
    //return str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($data))));
}
function format_cash($price)
{
    return str_replace(",", ".", number_format($price));
}

function random($string, $int)
{  
    return substr(str_shuffle($string), 0, $int);
}

function check_img($img)
{
    $filename = $_FILES[$img]['name'];
    $ext = explode(".", $filename);
    $ext = end($ext);
    $valid_ext = array("png","jpeg","jpg","PNG","JPEG","JPG","gif","GIF");
    if(in_array($ext, $valid_ext))
    {
        return true;
    }
}
function msg_success2($text, $url)
{
    return die('<script type="text/javascript">
        Swal.fire({
            title: "Thành Công",
            text: "'.$text.'",
            icon: "success",
            confirmButtonText: "OK"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "'.$url.'";
            }
        });
    </script>');
}
function msg_error2($text, $url = null, $time = 5000)
{
    return die('<script type="text/javascript">
        Swal.fire({
            toast: true,
            position: "bottom-end",
            icon: "error",
            title: "'.$text.'",
            showConfirmButton: false,
            timer: '.$time.'
        });
        '.($url ? 'setTimeout(function(){ location.href = "'.$url.'" }, '.$time.');' : '').'
    </script>');
}
function msg_warning2($text)
{
    return die('<script type="text/javascript">cuteToast({ type: "warning", message: "'.$text.'", timer: 5000 });</script>');
}
function msg_success($text, $url, $time)
{
    return die('<script type="text/javascript">
        Swal.fire({
            title: "Thành Công",
            text: "'.$text.'",
            icon: "success",
            confirmButtonText: "OK"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "'.$url.'";
            }
        });
    </script>');
}
function msg_error($text, $url, $time)
{
    return die('<script type="text/javascript">
        Swal.fire({
            title: "Thất bại",
            text: "'.$text.'",
            icon: "error",
            confirmButtonText: "OK"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "'.$url.'";
            }
        });
    </script>');
}
function msg_warning($text, $url, $time)
{
    return die('<script type="text/javascript">Swal.fire("Thông Báo", "'.$text.'","warning");
    setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
}

function display_banned($data)
{
    if ($data == 1)
    {
        $show = '<span class="badge badge-danger">Banned</span>';
    }
    else if ($data == 0)
    {
        $show = '<span class="badge badge-success">Hoạt động</span>';
    }
    return $show;
}

function XoaDauCach($text)
{
    return trim(preg_replace('/\s+/',' ', $text));
}
function display($data)
{
    if ($data == 'HIDE')
    {
        $show = '<span class="badge badge-danger">ẨN</span>';
    }
    else if ($data == 'SHOW')
    {
        $show = '<span class="badge badge-success">HIỂN THỊ</span>';
    }
    return $show;
}
function status($data)
{
    if ($data == 'xuly'){
        $show = '<span class="badge badge-info">Đang xử lý</span>';
    }
    else if ($data == 'hoantat'){
        $show = '<span class="badge badge-success">Hoàn tất</span>';
    }
    else if ($data == 'hoanthanh'){
        $show = '<span class="badge badge-success">Thành công</span>';
    }
    else if ($data == 'thatbai'){
        $show = '<span class="badge badge-danger">Thất bại</span>';
    }
    else if ($data == 'huy'){
        $show = '<span class="badge badge-danger">Hủy</span>';
    }
    else{
        $show = '<span class="badge badge-warning">Khác</span>';
    }
    return $show;
}

function check_username($data)
{
    if (preg_match('/^[a-zA-Z0-9_-]{3,16}$/', $data, $matches))
    {
        return True;
    }
    else
    {
        return False;
    }
}
function check_email($data)
{
    if (preg_match('/^.+@.+$/', $data, $matches))
    {
        return True;
    }
    else
    {
        return False;
    }
}
function TypePassword($string)
{
    return $string;
}
function AboutMe($username = null)
{
    global $CMSNT;
    
  
    if($username === null && isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    }
    
    
    if(empty($username)) {
        return false;
    }
    
    $user = $CMSNT->get_row("SELECT * FROM `users` WHERE `username` = '".check_string($username)."' ");
    
    if($user) {
        return [
            'id' => $user['id'],
            'username' => $user['username'],
            'money' => $user['money'],
            'level' => $user['level'],
            'banned' => $user['banned'],
            'createdate' => $user['createdate'],
            'email' => $user['email']
        ];
    }
    
    return false;
}