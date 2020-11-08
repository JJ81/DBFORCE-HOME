<html>
<head>
    <title>비밀번호 재설정중입니다.</title>
</head>
<body>
<?php
require_once('../autoload.php');
require_once('../commons/config.php');
require_once('../commons/utils.php');
require_once('../commons/session.php');


$password=getDataByPost('password');
$password2=getDataByPost('password2');
$hashCode=getDataByPost('hash');
// 1. 데이터 검사
// 공백 제거
$password=str_replace(" ", "", $password);
$password2=str_replace(" ", "", $password2);
$hashCode=str_replace(" ", "", $hashCode);

if(empty($password) or empty($password2) or empty($hashCode)){
    AlertMsgAndRedirectTo(ROOT . 'reset_pw?id='. $hashCode, "잘못된 접근입니다.");
    exit;
}

// 1. 비밀번호 두 개가 같은지 비교
if(strcmp($password, $password2) !== 0){
    AlertMsgAndRedirectTo(ROOT . 'reset_pw?id='. $hashCode, '[비밀번호오류] 입력하신 비밀번호가 일치하지 않습니다.');
    exit;
}

// 2. 비밀번호 암호화 처리
$options = [
    'cost' => 12,
];

$encrypt_password=password_hash($password, PASSWORD_BCRYPT, $options);

use JCORP\Business\Customer\HashService as Hash;
$hash=new Hash();

$user_info=$hash->getInfoByHash($hashCode);
$customer_id=$user_info[0]['customer_id'];

// 3. 비밀번호 데이터베이스에 업데이트
use JCORP\Business\Customer\CustomerRegService as CustomerReg;
$customer_inc=new CustomerReg();

$result=$customer_inc->setNewPassword($encrypt_password, $customer_id);

if(empty($result)){
    AlertMsgAndRedirectTo(ROOT, '처리도중 에러가 발생하였습니다. 다시 시도해 주세요.');
    exit;
}

// 4. 발급된 해시코드 만료시키기
$result_hash=$hash->expiredHash($customer_id, $hashCode);

error_log($result_hash);

?>

</body>
</html>

<?php
    if(empty($result_hash)){
        AlertMsgAndRedirectTo(ROOT  . 'login.php', '비밀번호 재설정에 실패하였습니다. 다시 시도해 주세요.');
    }else{
        AlertMsgAndRedirectTo(ROOT  . 'login.php', '비밀번호 재설정이 완료되었습니다.');
    }
?>
