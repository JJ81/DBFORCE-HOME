<html>
<head>
    <title>JCORPORATIONTECH, 문의를 요청중입니다.</title>
    <!-- 구글 태그매니저 처리여부 확인할 것. -->
<!--    <script async src="https://www.googletagmanager.com/gtag/js?id=?"></script>-->
<!--    <script>-->
<!--        window.dataLayer = window.dataLayer || [];-->
<!--        function gtag(){dataLayer.push(arguments);}-->
<!--        gtag('js', new Date());-->
<!--        gtag('config', 'AW-851709464');-->
<!--        gtag('event', 'conversion', {'send_to': '?/?'});-->
<!--    </script>-->
</head>
<body>
<?php
require_once('../autoload.php');
require_once('../commons/config.php');
require_once('../commons/utils.php');

if(
!isset($_POST['name']) or
!isset($_POST['tel-first']) or
!isset($_POST['tel-mid']) or
!isset($_POST['tel-end']) or
!isset($_POST['g-recaptcha-response'])
){
    AlertMsgAndRedirectTo(ROOT, '모든 정보를 입력해주세요.');
    exit;
}

$TITLE="[JTECH 알림] 고객문의가 접수되었음을 알려 드립니다.";
$name=getDataByPost('name');
$tel_first=getDataByPost('tel-first');
$tel_mid=getDataByPost('tel-mid');
$tel_end=getDataByPost('tel-end');
$captcha=$_POST['g-recaptcha-response'];

if(
    empty($name) or
    empty($tel_first) or
    empty($tel_mid) or
    empty($tel_end))
{
    AlertMsgAndRedirectTo(ROOT, '입력되지 않은 항목이 있습니다. 모두 입력해 주세요.');
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


// reCAPCHA 검증
$secretKey = "6LfNgZYUAAAAABdByeqN5CPDQQSP1ysBTG-dfS1a";
$ip = $_SERVER['REMOTE_ADDR']; // DB에 추가할 것.
$referrer=$_SERVER['HTTP_REFERER'];
$user_agent=$_SERVER['HTTP_USER_AGENT'];

$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
$responseKeys = json_decode($response, true);

error_log($responseKeys['success']);

if(intval($responseKeys["success"]) !== 1) {
    //echo '검증을 통과하지 못했습니다.';
    AlertMsgAndRedirectTo(ROOT , "[403][검증에러] 잘못된 접근입니다.");
    exit;
}


$phone=$tel_first .'-'. $tel_mid .'-'. $tel_end;
$company_id=1;

use JCORP\Business\Coupon\CouponService as Coupon;
$coupon=new Coupon();

// TODO 동일한 전화번호가 있는지 여부 판단
$is_duplicated=$coupon->checkDuplicatePhoneNumber($phone);
if(count($is_duplicated) > 0){
    AlertMsgAndRedirectTo(ROOT , "입력하신 번호로는 이미 쿠폰 번호가 발행되었습니다.");
    exit;
}

// TODO 쿠폰 번호 생성
$tmp_coupon_number=coupon_generator();

// TODO 동일한 쿠폰 번호가 있는지 판단
$prev_coupon=$coupon->checkDuplicatedCouponNumber($tmp_coupon_number);
if(count($prev_coupon) > 0){
    AlertMsgAndRedirectTo(ROOT , "일시적인 오류가 발생했습니다. 잠시 후에 다시 시도해주세요.");
    exit;
}

// 여기서부터 데이터베이스에 입력
use \JCORP\Database\DBConnection as DBconn;
$db=new DBconn();

// 트랜잭션이 필요함.
try{
    $db->getDBINS()->beginTransaction();


}catch(Exception $ex){
    $db->getDBINS()->rollBack();
    $db=null;

    error_log($ex);
    AlertMsgAndRedirectTo(ROOT, '일시적으로 오류가 발생하였습니다. 잠시 후에 다시 시도해 주세요.');
}

$query=
    "insert into `jp_ld_customer` (`name`, `phone`, `company_id`, `ip_addr`, `referrer`, `device_info`) ".
    "values ('$name', '$phone', $company_id, '$ip', '$referrer', '$user_agent')";
$inserted_id=$db->insert($query);


// 여기서부터는 SMS발송
use JCORP\Business\SMService\SMSender as SMS;
$sms=new SMS();

// TODO 기존에 입력된 메시지를 기반으로 수집된 전화번호로 쿠폰번호를 전달해야 함.

$message= "[고객문의] $name 고객님으로부터 문의가 접수되었습니다. 자세한 내용은 관리자에서 확인하세요. DBN: $phone";
$sms_sender=PHONE_NUMBER;
$receiver=$phone; // 문의를 준 고객을 대상으로 하나씩 생성하여 전달

if($inserted_id){

    $sms->setSMSData($message, $sms_sender, $receiver, SMS_TEST_MODE); // 데이터 세팅
    $result = $sms->sendMsg();
    $ret_json = json_decode($result);

    // -103에 대한 처리도 필요함.
    error_log('result code');
    error_log($ret_json->result_code);

    // SMS전송오류처리
    if($ret_json->result_code == "-101"){ // 인증 오류인경우
        error_log('[ERR] Authentication');
    }else if($ret_json->result_code == "-102"){ // API 인증 실패
        error_log('[ERR] Not authorized API networking.');
    }else if($ret_json->result_code == "-210"){ // 080이라는 문구가 들어가는 경우 에러
        error_log('[ERR] Message contains 080 number.');
    }else if($ret_json->result_code == "-103"){
        error_log('[ERR] Not registered number');
    }else if($ret_json->result_code == "-201"){
        error_log('[ERR] need to charge msg money');
    }
}

$db=null;

use JCORP\Email\EmailService;
$emailInc = new EmailService();

$emailInc->setEmailinfo(EMAIL_RECEIVER);
$htmlBody = "<div>고객명: $name</div>";
$htmlBody .= "<div>전화번호: $phone</div>";

$emailInc->setHTMLEmail($TITLE, $htmlBody);
$result_mail = $emailInc->sendEmail();

AlertMsgAndRedirectTo(ROOT, '정상적으로 접수되었습니다.');

?>
</body>
</html>
