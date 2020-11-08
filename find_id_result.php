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

// 공백 제거
$username=str_replace(" ", "", $username);
$email=str_replace(" ", "", $email);

// 쌍따옴표와 홑따움표 처리
$username=addslashes($username);
$email=addslashes($email);

if(empty($username) or empty($email)){
    AlertMsgAndRedirectTo(ROOT . 'find_id.php', '잘못된 접근입니다.');
    exit;
}


use JCORP\Business\Customer\CustomerRegService as CustomerReg;
$customer_inc=new CustomerReg();
$result=$customer_inc->queryUserIdByEmailAndUserName($username, $email);

//error_log('Check Result');
//error_log(print_r($result, true));

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <?php require_once('./inc/head.php') ;?>
    <title><?php echo $info[0]['title'];?>, 아이디 찾기 결과</title>
</head>

<body <?php if(isMobile() === false){ echo 'style="padding-bottom: 150px;"';} ?>>

<?php require_once('./inc/preloader.php') ;?>

<?php if(isMobile()){ ?>

    <?php require_once ('./inc/vt-header-m.php');?>

    <div id="jp-content-m">
        <div class="page-m-content">


            <div class="register-form-wrp">
                <div class="register-form-body">
                    <div class="register-form-body-wrp" style="border: 1px solid #e7e7e7;">
                        <div class="display-find-id-result">
                            <h2 class="register-form-title">아이디 찾기 결과</h2>
                            <div class="register-form-desc">회원정보에 저장된 이메일 주소로 아이디를 찾을 수 있습니다.</div>

                            <div class="display-find-id-result-body">
                                ID:
                                <?php if(empty($result[0]['user_id'])){ ?>
                                    일치하는 정보가 없습니다.
                                <?php }else{ ?>
                                    <strong><?php echo hideInfoWithString(60, $result[0]['user_id']);?></strong>
                                <?php } ?>
                            </div>

                            <div class="display-find-id-btn-area">
                                <div>
                                    <a href="./login.php" class="btn-login-after-find-id">로그인</a>
                                </div>

                                <div style="margin: 10px 0 20px;">
                                    <a href="./find_pw.php" class="btn-find-pw-after-find-id">비밀번호 찾기</a>
                                </div>

                                <div>
                                    <a href="./find_id.php"
                                       style="text-decoration: underline;font-size: 13px;">아이디 다시 찾기</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="register-form-body">
                    <div class="register-form-body-wrp" style="border: 1px solid #e7e7e7;">
                        <div class="display-find-id-result">
                            <h2 class="register-form-title">전체 아이디 찾기</h2>
                            <div class="register-form-desc">전체 아이디는 회원가입시 등록하신 이메일 주소로 발송됩니다.</div>

                            <div class="display-find-id-btn-area">
                                <div style="margin: 20px 0;">
                                    <form method="post" action="<?php echo ROOT;?>response/res_send_email_with_id.php">
                                        <input type="hidden" name="name" value="<?php echo $username;?>"  required />
                                        <input type="hidden" name="email" value="<?php echo $email;?>"  required />
                                        <button type="submit" class="btn-find-pw-after-find-id">
                                            <img src="<?php echo ROOT;?>assets/img/common/ico-envelop.jpg" alt="" width="30" style="position: relative;top: -2px;left: -2px;" />
                                            이메일로 발송
                                            <img src="<?php echo ROOT;?>assets/img/common/ico-angle-right-black.jpg" alt="" width="10" style="position: relative;top: -2px;left: 10px;" />
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <?php require_once ('./inc/vt-footer-m.php');?>

<?php } else { ?>

    <?php require_once ('./inc/vt-header-main.php');?>
    <?php require_once ('./inc/notice-common-pc.php');?>

    <div class="contents-pc">
        <div class="register-form-wrp">
            <div class="register-form-body">
                <div class="register-form-body-wrp" style="border: 1px solid #e7e7e7;">
                    <div class="display-find-id-result">
                        <h2 class="register-form-title">아이디 찾기 결과</h2>
                        <div class="register-form-desc">회원정보에 저장된 이메일 주소로 아이디를 찾을 수 있습니다.</div>

                        <div class="display-find-id-result-body">
                            ID:
                            <?php if(empty($result[0]['user_id'])){ ?>
                                일치하는 정보가 없습니다.
                            <?php }else{ ?>
                                <strong><?php echo hideInfoWithString(60, $result[0]['user_id']);?></strong>
                            <?php } ?>
                        </div>

                        <div class="display-find-id-btn-area">
                            <div>
                                <a href="./login.php" class="btn-login-after-find-id">로그인</a>
                            </div>

                            <div style="margin: 10px 0 20px;">
                                <a href="./find_pw.php" class="btn-find-pw-after-find-id">비밀번호 찾기</a>
                            </div>

                            <div>
                                <a href="./find_id.php" style="text-decoration: underline;">아이디 다시 찾기</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="register-form-body">
                <div class="register-form-body-wrp" style="border: 1px solid #e7e7e7;">
                    <div class="display-find-id-result">
                        <h2 class="register-form-title">전체 아이디 찾기</h2>
                        <div class="register-form-desc">전체 아이디는 회원가입시 등록하신 이메일 주소로 발송됩니다.</div>

                        <div class="display-find-id-btn-area">
                            <div style="margin: 20px 0;">
                                <form method="post" action="<?php echo ROOT;?>response/res_send_email_with_id.php">
                                    <input type="hidden" name="name" value="<?php echo $username;?>"  required />
                                    <input type="hidden" name="email" value="<?php echo $email;?>"  required />
                                    <button type="submit" class="btn-find-pw-after-find-id">
                                        <img src="<?php echo ROOT;?>assets/img/common/ico-envelop.jpg" alt="" width="30" style="position: relative;top: -2px;left: -2px;" />
                                        이메일로 발송
                                        <img src="<?php echo ROOT;?>assets/img/common/ico-angle-right-black.jpg" alt="" width="10" style="position: relative;top: -2px;left: 10px;" />
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once ('./inc/vt-footer.php');?>


<?php } ?>

<?php require_once ('./inc/foot.php');?>
<script>

</script>
</body>
</html>