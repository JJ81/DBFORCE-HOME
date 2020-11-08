<html>
<head>
    <title>이메일을 발송중입니다.</title>
</head>
<body>
<?php
require_once('../autoload.php');
require_once('../commons/config.php');
require_once('../commons/utils.php');
require_once('../commons/session.php');


$username=getDataByPost('name');
$email=getDataByPost('email');
$user_id=null;
$result=null;

// 1. 데이터 검사
// 공백 제거
$username=str_replace("", "", $username);
$email=str_replace("", "", $email);

// 쌍따옴표와 홑따움표 처리
$username=addslashes($username);
$email=addslashes($email);

if(empty($username) or empty($email)){
    AlertMsgAndRedirectTo(ROOT . 'find_id.php', '잘못된 접근입니다.');
    exit;
}

// 2. $user_id 조회
use \JCORP\Business\Customer\CustomerRegService as CustomerReg;
$customer_inc=new CustomerReg();

$result=$customer_inc->queryUserIdByEmailAndUserName($username, $email);

if(count($result) == 0){
    AlertMsgAndRedirectTo(ROOT  . 'login.php', '조회된 정보가 없습니다.');
    exit;
}

$user_id=$result[0]['user_id'];

// 3. 이메일 발송
use JCORP\Email\EmailService;
$emailInc = new EmailService();

$TITLE="[한국경제투자TV] 고객님의 아이디를 발송합니다.";
$emailInc->setEmailinfo($email);
$htmlBody = "<h1>한국경제투자TV</h1>";
$htmlBody = "<div>한국경제투자TV에서 고객님의 아이디를 발송합니다.</div>";
$htmlBody .= "<div>ID: $user_id</div>";
$emailInc->setHTMLEmail($TITLE, $htmlBody);
$result_mail = $emailInc->sendEmail();

error_log('$result_mail');
error_log(print_r($result_mail, true));

?>

</body>
</html>

<?php
    if(empty($result)){
        AlertMsgAndRedirectTo(ROOT  . 'login.php', '메일발송이 되지 않았습니다. 다시 시도해 주세요.');
    }else{
        AlertMsgAndRedirectTo(ROOT  . 'login.php', '등록하신 메일로 아이디가 발송되었습니다.');
    }
?>
