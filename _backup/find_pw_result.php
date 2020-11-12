<?php
require_once('./autoload.php');
require_once('./commons/config.php');
require_once('./commons/utils.php');
require_once('./commons/session.php');

define('PAGE','LOGIN');

use JCORP\Business\Basics\BasicInfoService as Basic;
$basic=new Basic();

$company_id=1; // 설정시 강제세팅값필요
$info=$basic->getBasicInfoByCompany_id($company_id);

use JCORP\Business\Notice\NoticeService as Notice;
$notice=new Notice();
$notice_lists=$notice->getList(0, 3); // 최신글 3개

if(!empty($_SESSION['user_uuid'])){
    Redirect(ROOT);
    exit;
}

// 1. POST로 전달받은 정보에 따라서 ID를 조회한다.
$username=getDataByPost('user_name');
$email=getDataByPost('email');
$user_id=getDataByPost('user_id');

// 공백 제거
$username=str_replace(" ", "", $username);
$email=str_replace(" ", "", $email);
$user_id=str_replace(" ", "", $user_id);

// 쌍따옴표와 홑따움표 처리
$username=addslashes($username);
$email=addslashes($email);
$user_id=addslashes($user_id);

if(empty($username) or empty($email) or empty($user_id)){
    AlertMsgAndRedirectTo(ROOT . 'find_pw.php', '잘못된 접근입니다.');
    exit;
}

use JCORP\Business\Customer\CustomerRegService as CustomerReg;
$customer_inc=new CustomerReg();

// 수집된 데이터를 존재여부를 확인한 이후에 발송이 가능할 경우와 불가능한 경우를 화면에 출력한다.
$result=$customer_inc->queryUserIdByEmailAndUserNameAndUserId($username, $email, $user_id);


?>
    <!DOCTYPE html>
    <html lang="ko">
    <head>
        <?php require_once('./inc/head.php');?>
        <title><?php echo $info[0]['title'];?>, 비밀번호 찾기</title>
    </head>

    <body <?php if(isMobile() === false){ echo 'style="padding-bottom: 150px;"';} ?>>

    <?php require_once('./inc/preloader.php');?>

    <?php if(isMobile()){ ?>

        <?php require_once('./inc/vt-header-m.php');?>

        <div id="jp-content-m">
            <div class="register-form-wrp">
                <div class="register-form-body">
                    <div class="register-form-body-wrp" style="padding-bottom: 100px;">
                        <h2 class="register-form-title">이메일 발송</h2>
                        <?php if($result[0]['total'] == '0' or empty($result[0]['total'])){ ?>
                            <div class="register-form-desc" style="margin-top: 40px;">메일 발송에 실패하였습니다. 다시 시도해 주세요.</div>
                        <?php }else { ?>
                            <div class="register-form-desc" style="margin-top: 40px;">이메일이 발송되었습니다. <br />메일 확인 후에 비밀번호를 재설정하시기 바랍니다.</div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once('./inc/vt-footer-m.php');?>

    <?php } else { ?>

        <?php require_once('./inc/vt-header-main.php');?>
        <?php require_once('./inc/notice-common-pc.php');?>

        <div class="contents-pc">
            <div class="register-form-wrp">
                <div class="register-form-body">
                    <div class="register-form-body-wrp">
                        <h2 class="register-form-title">이메일 발송</h2>
                        <?php if($result[0]['total'] == '0' or empty($result[0]['total'])){ ?>
                            <div class="register-form-desc" style="margin-top: 40px;">메일 발송에 실패하였습니다. 다시 시도해 주세요.</div>
                        <?php }else { ?>
                            <div class="register-form-desc" style="margin-top: 40px;">이메일이 발송되었습니다. <br />메일 확인 후에 비밀번호를 재설정하시기 바랍니다.</div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once('./inc/vt-footer.php');?>

    <?php } ?>

    <?php require_once('./inc/foot.php');?>
    <script>

    </script>
    </body>
    </html>

<?php

if($result[0]['total'] == '0'){
    exit;
}

$customer_id=$result[0]['customer_id'];

use JCORP\Business\Customer\HashService as Hash;
$hash=new Hash();
$new_hash=$hash->genHashCode($customer_id);
$result_set_hash=$hash->setHash($customer_id, $new_hash);

if(empty($result_set_hash)){
    AlertMsgAndRedirectTo(ROOT . 'find_pw.php', '알 수 없는 오류가 발생했습니다. 잠시 후에 다시 시도해 주세요.');
    exit;
}

$url=ROOT . 'reset_pw.php?id=' . $new_hash;

use JCORP\Email\EmailService;
$emailInc = new EmailService();

$TITLE="[한국경제투자TV] 고객님의 비밀번호를 재설정합니다.";
$emailInc->setEmailinfo($email);
$htmlBody = "<h1>한국경제투자TV</h1>";
$htmlBody = "<div>한국경제투자TV에서 고객님의 비밀번호를 재설정하기 위하여 아래의 링크를 발송합니다.</div>";
$htmlBody = "<div>발송일로부터 1주일간만 유효하며 그 이후에는 다시 비밀번호 찾기를 진행하셔야 합니다.</div>";
$htmlBody .= "<div><a href='".$url."' target='_blank'>비밀번호 재설정하기</a></div>";
$emailInc->setHTMLEmail($TITLE, $htmlBody);
$result_mail = $emailInc->sendEmail();

error_log('$result_mail');
error_log(print_r($result_mail, true));


?>