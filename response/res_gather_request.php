<html>
<head>
    <title>요청하신 문의를 처리중입니다.</title>
</head>
<body>
<?php
require_once('../autoload.php');
require_once('../commons/config.php');
require_once('../commons/utils.php');

if(!isset($_POST['name']) or !isset($_POST['tel'])) {
    AlertMsgAndRedirectTo(ROOT, '누락된 필수 정보가 있습니다.');
    exit;
}


$name=getDataByPost('name');
$phone=getDataByPost('tel');
$path=getDataByPost('path');
$req_item_type=getDataByPost('req_item_type');


if(strpos($phone, '-') ===false){
    AlertMsgAndRedirectTo(ROOT, '전화번호에 - 이 포함되어 있지 않습니다.');
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
    AlertMsgAndRedirectTo(ROOT, '잘못 입력되거나 누락이 된 항목이 있습니다. 다시 입력해 주세요.');
    exit;
}


if(empty($name) or empty($tel_first) or empty($tel_mid) or empty($tel_end)){
    AlertMsgAndRedirectTo(ROOT, '필수입력사항이 누락되어 있습니다.');
    exit;
}

if(strlen($tel_first)<2 or strlen($tel_mid)<3 or strlen($tel_end)<3){
    AlertMsgAndRedirectTo(ROOT, '[번호오류] 잘못된 접근입니다.');
    exit;
}

// 숫자인지부터 서버단에서 중복 검토 진행
if(is_numeric($tel_first) == false or is_numeric($tel_mid) == false or is_numeric($tel_end) == false){
    AlertMsgAndRedirectTo(ROOT, '[번호오류] 잘못된 전화번호입니다.');
    exit;
}

$ip = $_SERVER['REMOTE_ADDR']; // DB에 추가할 것.
$referrer=getDataByPost('referrer');
$user_agent=$_SERVER['HTTP_USER_AGENT'];
$phone=$tel_first .'-'. $tel_mid .'-'. $tel_end;
$company_id=1;
$admin_id=1;


use \JCORP\Business\Customer\CustomerService as Customer;
$customer=new Customer();


if(empty($referrer)){
    $referrer=NULL;
}

if(empty($req_item_type)){
    $req_item_type=NULL;
}

$result_insert_customer_info=$customer->setCustomerInfo($name, $phone, $company_id, null, $ip, $referrer, $user_agent, $req_item_type, $path);

if(empty($result_insert_customer_info)){
    AlertMsgAndRedirectTo(ROOT, '접수가 되지 않았습니다. 잠시 후에 다시 시도해 주세요.');
}else{
    AlertMsgAndRedirectTo(ROOT, '정상적으로 접수되었습니다.');
}
?>

</body>
</html>