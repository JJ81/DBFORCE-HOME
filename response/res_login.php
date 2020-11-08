<html>
<head>
    <title>로그인을 진행중입니다.</title>
</head>
<body>
<?php
require_once('../autoload.php');
require_once('../commons/config.php');
require_once('../commons/utils.php');
require_once('../commons/session.php');

if(!isset($_POST['user_id']) or !isset($_POST['password'])) {
    AlertMsgAndRedirectTo(ROOT . 'login.php', '필수 입력 정보가 누락되있습니다.');
    exit;
}

use \JCORP\Business\Customer\CustomerRegService as CustomerReg;
$customer=new CustomerReg();

$user_id=getDataByPost('user_id');
$password=getDataByPost('password');

$user_id=addslashes($user_id);

$user_id=trim($user_id);
$password=trim($password);


$user_info=$customer->checkListByUserId($user_id);

if(count($user_info) == 0){
    AlertMsgAndRedirectTo(ROOT . 'login.php', '등록된 정보가 없습니다.');
    exit;
}

$is_available=$user_info[0]['is_delete'];

error_log('$is_available');
error_log($is_available);

if($is_available == "1"){
    AlertMsgAndRedirectTo(ROOT, '사용할 수 없는 계정입니다.');
    exit;
}

$encrypted_password=$user_info[0]['password'];

if(password_verify($password, $encrypted_password)){
    $_SESSION['user_uuid'] = $user_info[0]['id'];
    $_SESSION['user_uid'] = $user_info[0]['user_id'];
    $_SESSION['username'] = $user_info[0]['name'];
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + SESS_DURATION;

    AlertMsgAndRedirectTo(ROOT ,  $_SESSION['username'] . "님, 환영합니다!");
}else{

    AlertMsgAndRedirectTo(ROOT . 'login.php', '비밀번호가 일치하지 않습니다.');
    exit;
}

?>

</body>
</html>