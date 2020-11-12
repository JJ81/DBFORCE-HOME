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
    <title><?php echo $info[0]['title'];?></title>
</head>

<body <?php if(isMobile() === false){ echo 'style="padding-bottom: 150px;"';} ?>>

<?php require_once('./inc/preloader.php');?>

<?php if(isMobile()){ ?>

    <?php require_once('./inc/vt-header-m.php');?>

    <div id="jp-content-m">
        <div class="page-m-header">
            <h2 class="center">
                <img src="<?php echo ROOT;?>assets/img/mobile/login/img-tit-login.jpg" alt="" width="100" />
            </h2>
            <h3 class="center">
                <img src="<?php echo ROOT;?>assets/img/mobile/login/img-tit-login-sub.jpg" alt="" width="300" />
            </h3>
        </div>

        <div class="page-m-content">
            <div class="midLine5"></div>

            <div class="login-m-wrp">
                <form action="<?php echo ROOT;?>response/res_login.php" method="post" class="form-login">
                    <div class="form-group">
                        <input type="text" name="user_id" class="form-control" required placeholder="아이디를 입력하세요." />
                    </div>
                    <div class="form-group" style="margin: 14px 0 14px;">
                        <input type="password" name="password" class="form-control" required placeholder="비밀번호를 입력하세요." />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success login-m-btn">
                            <img src="<?php echo ROOT;?>assets/img/mobile/login/btn-login-page.jpg" alt="" width="100%" />
                        </button>
                    </div>
                    <div class="login-m-bottom-link-area">
                        <a href="find_id.php">아이디찾기</a>
                        <span>|</span>
                        <a href="find_pw.php">비밀번호찾기</a>
                        <span>|</span>
                        <a href="register.php">회원가입</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require_once('./inc/vt-footer-m.php');?>

<?php } else { ?>

    <div id="login-area-pc">
        <div class="login-area-inner">
            <form action="<?php echo ROOT;?>response/res_login.php" method="post" class="form-login">
                <h1 class="center" style="margin-bottom: 30px;">
                    <a href="/">
                        <img src="<?php echo ROOT;?>assets/img/common/logo-common.png" alt="" width="330" />
                    </a>
                </h1>
                <div class="form-group">
                    <input type="text" name="user_id" class="form-control" required placeholder="아이디" />
                </div>
                <div class="form-group" style="margin: 14px 0 14px;">
                    <input type="password" name="password" class="form-control" required placeholder="비밀번호" />
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success login-m-btn">
                        <img src="<?php echo ROOT;?>assets/img/mobile/login/btn-login-page.jpg" alt="" width="100%" />
                    </button>
                </div>
                <div class="login-m-bottom-link-area">
                    <a href="register.php">회원가입</a>
                    <span>|</span>
                    <a href="find_id.php">아이디/비밀번호찾기</a>
                    <span>|</span>
                    <a href="..">메인으로 돌아가기</a>
                </div>
            </form>
        </div>
    </div>


<?php } ?>

<?php require_once('./inc/foot.php');?>
<script>

</script>
</body>
</html>