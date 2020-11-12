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
        <div class="page-m-header">
            <h2 class="center">
                <img src="<?php echo ROOT;?>assets/img/mobile/login/img-tit-find-pw.jpg" alt="" width="120" />
            </h2>
            <h3 class="center" style="padding-top: 5px;">
                <img src="<?php echo ROOT;?>assets/img/mobile/login/img-tit-find-pw-sub.jpg" alt="" width="240" />
            </h3>
        </div>

        <div class="page-m-content">
            <div class="midLine5"></div>

            <div class="login-m-wrp">
                <form action="<?php echo ROOT;?>find_pw_result.php" method="post" class="form-login">
                    <div class="form-group">
                        <input type="text" name="user_id" class="form-control" required placeholder="아이디을 입력하세요." />
                    </div>
                    <div class="form-group" class="form-group" style="margin: 14px 0 14px;">
                        <input type="text" name="user_name" class="form-control" required placeholder="이름을 입력하세요." />
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" required placeholder="가입하신 이메일 주소를 입력하세요." />
                    </div>
                    <div class="form-group" style="margin-top: 14px;">
                        <button type="submit" class="btn btn-success login-m-btn">
                            <img src="<?php echo ROOT;?>assets/img/mobile/login/btn-confirm-m.jpg" alt="" width="100%" />
                        </button>
                    </div>
                    <div class="login-m-bottom-link-area">
                        <a href="find_id.php">아이디찾기</a>
                        <span>|</span>
                        <a href="register.php">회원가입</a>
                    </div>
                </form>
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
                <h2 class="register-form-title">비밀번호 찾기</h2>
                <div class="register-form-desc">회원가입시 입력한 정보로 비밀번호를 새로 설정할 수 있습니다.</div>

                <div class="register-form-body-wrp">
                    <form action="<?php echo ROOT;?>find_pw_result.php" method="post" class="form-register">
                        <div class="form-group">
                            <input type="text" name="user_id" placeholder="아이디를 입력하세요" required />
                        </div>
                        <div class="form-group" style="margin-top: 20px;">
                            <input type="text" name="user_name" placeholder="이름을 입력하세요" required />
                        </div>
                        <div class="form-group" style="margin: 20px 0;">
                            <input type="email" name="email" placeholder="이메일을 입력하세요" required />
                        </div>
                        <div style="text-align: center;margin-top: 50px;">
                            <button type="submit" class="btn-submit-find-id">확인</button>
                        </div>
                        <div style="text-align: center;margin-top: 10px;">
                            <a href="find_id.php" class="btn-find-pw-after-find-id">아이디 찾기</a>
                        </div>
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