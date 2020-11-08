<html>
<head>
    <title>회원가입을 진행중입니다.</title>
</head>
<body>
<?php
require_once('../autoload.php');
require_once('../commons/config.php');
require_once('../commons/utils.php');
require_once('../commons/session.php');

if(!isset($_POST['name']) or !isset($_POST['tel'])) {
    AlertMsgAndRedirectTo(ROOT . 'register.php', '누락된 필수 정보가 있습니다.');
    exit;
}

use \JCORP\Business\Customer\CustomerRegService as CustomerReg;
$customer=new CustomerReg();


$name=getDataByPost('name');
$phone=getDataByPost('tel');
$email=getDataByPost('email');
$user_id=getDataByPost('user_id');
$password=getDataByPost('password');
$password2=getDataByPost('password2');

if(empty($user_id) or empty($password) or empty($password2) or empty($phone) or empty($name))
{
    AlertMsgAndRedirectTo(ROOT. 'register.php', '필수입력값이 누락되었습니다.');
    exit;
}

// 1. 아이디 중복 검사
$result_dup=$customer->checkDuplicateUserId($user_id);
if($result_dup[0]['total'] !== '0'){
    AlertMsgAndRedirectTo(ROOT. 'register.php', '중복된 아이디입니다.');
    exit;
}

// 2. 핸드폰 번호 형식 검사 및 조정
if(strpos($phone, '-') ===false){
    AlertMsgAndRedirectTo(ROOT. 'register.php', '전화번호에 - 이 포함되어 있지 않습니다.');
    exit;
}

// phone을 - 을 기준으로 나누어서 아래 변수에 할당
$tmp_phone=explode('-', $phone);

$tel_first=(empty($tmp_phone[0])) ? null : $tmp_phone[0];
$tel_mid=(empty($tmp_phone[1])) ? null : $tmp_phone[1];
$tel_end=(empty($tmp_phone[2])) ? null : $tmp_phone[2];

error_log($tel_first);
error_log($tel_mid);
error_log($tel_end);

if(
    empty($name) or
    empty($tel_first) or
    empty($tel_mid) or
    empty($tel_end))
{
    AlertMsgAndRedirectTo(ROOT. 'register.php', '잘못 입력되거나 누락이 된 항목이 있습니다. 다시 입력해 주세요.');
    exit;
}


if(empty($name) or empty($tel_first) or empty($tel_mid) or empty($tel_end)){
    AlertMsgAndRedirectTo(ROOT. 'register.php', '필수입력사항이 누락되어 있습니다.');
    exit;
}

if(strlen($tel_first)<2 or strlen($tel_mid)<3 or strlen($tel_end)<3){
    AlertMsgAndRedirectTo(ROOT. 'register.php', '[번호오류] 잘못된 접근입니다.');
    exit;
}

// 숫자인지부터 서버단에서 중복 검토 진행
if(is_numeric($tel_first) == false or is_numeric($tel_mid) == false or is_numeric($tel_end) == false){
    AlertMsgAndRedirectTo(ROOT. 'register.php', '[번호오류] 잘못된 전화번호입니다.');
    exit;
}

$phone=$tel_first .'-'. $tel_mid .'-'. $tel_end;

// 3. 비밀번호 일치 검사 및 4자리 이상만 허용 처리
if(strlen(trim($password)) < 4){
    AlertMsgAndRedirectTo(ROOT. 'register.php', '[비밀번호오류] 비밀번호는 반드시 4자 이상이어야 합니다.');
    exit;
}

error_log('Check Password');
error_log($password);
error_log($password2);
error_log(trim($password));
error_log(trim($password2));
error_log(trim($password) == trim($password2));

$password=trim($password);
$password2=trim($password2);

if(strcmp($password, $password2) !== 0){
    AlertMsgAndRedirectTo(ROOT. 'register.php', '[비밀번호오류] 입력하신 비밀번호가 일치하지 않습니다.');
    exit;
}

// 4. 비밀번호 암호화 처리 hash_password
$options = [
    'cost' => 12,
];

$encrypt_password=password_hash($password, PASSWORD_BCRYPT, $options);

// TODO 관리자의 로그인 및 비밀번호 변경 로직에서도 hash_password로 처리할 것.



$ip = $_SERVER['REMOTE_ADDR']; // DB에 추가할 것.
$referrer=getDataByPost('referrer');
$user_agent=$_SERVER['HTTP_USER_AGENT'];

$company_id=1;
$admin_id=1;

if(empty($referrer)){
    $referrer=NULL;
}


$result_insert_customer_info=$customer->setNewCustomer($name, $phone, $user_id, $encrypt_password, $email);

if(empty($result_insert_customer_info)){
    AlertMsgAndRedirectTo(ROOT, '회원가입이 되지 않았습니다. 잠시 후에 다시 시도해 주세요.');
}else{
    AlertMsgAndRedirectTo(ROOT, '정상적으로 가입되었습니다.');
}
?>

</body>
</html>