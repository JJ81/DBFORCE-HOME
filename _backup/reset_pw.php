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

$hashCode=getDataByGet('id');
$hashCode=str_replace(" ", "", $hashCode);
$hashCode=addslashes($hashCode);

if(empty($hashCode)){
    AlertMsgAndRedirectTo(ROOT, '잘못된 접근입니다.');
    exit;
}

error_log('ID');
error_log($hashCode);

use JCORP\Business\Customer\HashService as Hash;
$hash=new Hash();
$user_info=$hash->getInfoByHash($hashCode);

if(count($user_info) == 0){
    AlertMsgAndRedirectTo(ROOT, '더 이상 유효한 페이지가 아닙니다.');
    exit;
}

$expiry_dt=new DateTime($user_info[0]['created_dt']);
$today=new DateTime(getToday('Y-m-d H:i:s'));

if(date_diff($expiry_dt, $today)->days > 7){
    AlertMsgAndRedirectTo(ROOT, '[기간만료] 더 이상 유효한 페이지가 아닙니다.');
    exit;
}


?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <?php require_once('./inc/head.php');?>
    <title><?php echo $info[0]['title'];?>, 비밀번호 재설정</title>
</head>

<body <?php if(isMobile() === false){ echo 'style="padding-bottom: 150px;"';} ?>>

<?php require_once('./inc/preloader.php');?>

<?php if(isMobile()){ ?>

    <?php require_once('./inc/vt-header-m.php');?>

    <div id="jp-content-m">

        <div class="register-form-wrp">
            <div class="register-form-body">
                <div class="register-form-body-wrp" style="border: 1px solid #e7e7e7;">
                    <h2 class="register-form-title">비밀번호 재설정</h2>
                    <div class="register-form-desc">새로운 비밀번호를 설정해 주세요.</div>

                    <form action="<?php echo ROOT;?>response/res_set_new_pw.php" method="post" class="form-register">
                        <div class="form-group">
                            <input type="password" name="password" placeholder="비밀번호" required />
                        </div>
                        <div class="form-group" style="margin: 10px 0;">
                            <input type="password" name="password2" placeholder="비밀번호 재확인" required />
                        </div>
                        <div style="text-align: center;margin-top: 20px;">
                            <button type="submit" class="btn-submit-find-id">확인</button>
                        </div>
                        <div style="text-align: center;margin-top: 10px;margin-bottom: 40px;">
                            <a href="login.php" class="btn-find-pw-after-find-id">로그인 하기</a>
                        </div>

                        <input type="hidden" name="hash" value="<?php echo $hashCode;?>" />

                    </form>
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
                <div class="register-form-body-wrp" style="border: 1px solid #e7e7e7;">
                    <h2 class="register-form-title">비밀번호 재설정</h2>
                    <div class="register-form-desc">새로운 비밀번호를 설정해 주세요.</div>

                    <form action="<?php echo ROOT;?>response/res_set_new_pw.php" method="post" class="form-register">
                        <div class="form-group">
                            <input type="password" name="password" placeholder="비밀번호" required />
                        </div>
                        <div class="form-group" style="margin: 20px 0;">
                            <input type="password" name="password2" placeholder="비밀번호 재확인" required />
                        </div>
                        <div style="text-align: center;margin-top: 50px;">
                            <button type="submit" class="btn-submit-find-id">확인</button>
                        </div>
                        <div style="text-align: center;margin-top: 10px;">
                            <a href="login.php" class="btn-find-pw-after-find-id">로그인 하기</a>
                        </div>

                        <input type="hidden" name="hash" value="<?php echo $hashCode;?>" />

                    </form>
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