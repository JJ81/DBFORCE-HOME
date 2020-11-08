<?php
require_once('./autoload.php');
require_once('./commons/config.php');
require_once('./commons/utils.php');
require_once('./commons/session.php');

define('PAGE','REGISTER');

//use JCORP\Business\Basics\BasicInfoService as Basic;
//$basic=new Basic();
//
//$company_id=1; // 설정시 강제세팅값필요
//$info=$basic->getBasicInfoByCompany_id($company_id);
//
//use JCORP\Business\Notice\NoticeService as Notice;
//$notice=new Notice();
//$notice_lists=$notice->getList(0, 3); // 최신글 3개

require_once ('./inc/common-data.php');

if(!empty($_SESSION['user_uuid'])){
    Redirect(ROOT);
    exit;
}

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <?php require_once('./inc/head.php') ;?>
    <title><?php echo $info[0]['title'];?></title>
</head>

<body <?php if(isMobile() === false){ echo 'style="padding-bottom: 150px;"';} ?>>

<?php require_once('./inc/preloader.php') ;?>

<?php if(isMobile()){ ?>

    <?php require_once ('./inc/vt-header-m.php');?>

    <div id="jp-content-m">

        <div class="page-m-header">
            <h2 class="center">
                <img src="<?php echo ROOT;?>assets/img/mobile/login/img-tit-register.jpg" alt="" width="100" />
            </h2>
            <h3 class="center">
                <img src="<?php echo ROOT;?>assets/img/mobile/login/img-tit-login-sub.jpg" alt="" width="300" />
            </h3>
        </div>

        <div class="page-m-content">
            <div class="midLine5"></div>

            <div class="login-m-wrp">
                <form action="<?php echo ROOT;?>response/res_register.php" method="post" class="form-register">
                    <h4 class="section-title-m">기본정보</h4>
                    <div class="form-group">
                        <input type="text" class="form-control js-reg-name" name="name" placeholder="이름" maxlength="20" required />
                    </div>

                    <div class="form-group" style="padding: 10px 0;">
                        <input type="tel" class="form-control js-reg-phone" name="tel" placeholder="휴대전화번호" maxlength="13" required />
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-control js-reg-email" name="email" placeholder="이메일주소" />
                        <div class="msg-m-reg-email">휴대전화번호와 이메일 정보가 맞지 않을 경우, 아이디/비밀번호 찾기를 진행할 수가 없습니다.</div>
                    </div>

                    <hr />

                    <div class="form-group">
                        <input type="text" class="form-control js-reg-id" name="user_id" placeholder="아이디" required style="padding-right: 100px;" />
                        <a href="#" class="btn btn-warning js-btn-duplicate">중복검사</a>
                    </div>

                    <div class="form-group" style="padding: 10px 0;">
                        <input type="password" class="form-control js-reg-pw" name="password" placeholder="비밀번호" required />

                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control js-reg-pw2" name="password2" placeholder="비밀번호(확인)" required />
                    </div>

                    <div style="height:2px;background:#e2e2e2;margin-top: 30px;"></div>

                    <div style="margin-top: 15px;">
                        <h4 class="section-title-m">개인정보취급방침</h4>
                        <div class="privacy-box-m">
                            <div style="white-space: pre-line;"><?php echo html_entity_decode($info[0]['privacy']);?></div>
                        </div>

                        <div style="margin-top: 5px;">
                            <input type="checkbox" id="privacy_agree" required checked class="js-reg-privacy" />
                            <label for="privacy_agree">위의 사항에 모두 동의합니다.</label>
                        </div>
                    </div>

                    <div style="margin-top: 15px;">
                        <h4 class="section-title-m">이용약관</h4>

                        <div class="privacy-box-m">
                            <div style="white-space: pre-line;line-height: 22px;"><?php echo html_entity_decode($info[0]['agreement']);?></div>
                        </div>

                        <div style="margin-top: 5px;">
                            <input type="checkbox" id="agreement_agree" required checked class="js-reg-agreement" />
                            <label for="agreement_agree">위의 사항에 모두 동의합니다.</label>
                        </div>
                    </div>

                    <div style="margin-top: 20px;">
                        <button type="submit" class="btn btn-primary js-btn-register">
                            <img src="<?php echo ROOT;?>assets/img/mobile/login/btn-register-m.jpg" alt="" width="100%" />
                        </button>
                    </div>
                </form>
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
                <h2 class="register-form-title">회원가입</h2>
                <div class="register-form-desc">한국경제투자TV에 오신 것을 환영합니다.</div>

                <div class="register-form-body-wrp">
                    <form action="<?php echo ROOT;?>response/res_register.php" method="post" class="form-register">
                        <h4 class="section-title-m">기본정보</h4>
                        <div class="form-group">
                            <input type="text" class="form-control js-reg-name" name="name" placeholder="이름" maxlength="20" required />
                        </div>

                        <div class="form-group" style="padding: 10px 0;">
                            <input type="tel" class="form-control js-reg-phone" name="tel" placeholder="휴대전화번호" maxlength="13" required />
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control js-reg-email" name="email" placeholder="이메일주소" />
                            <div class="msg-m-reg-email">휴대전화번호와 이메일 정보가 맞지 않을 경우, 아이디/비밀번호 찾기를 진행할 수가 없습니다.</div>
                        </div>

                        <hr />

                        <div class="form-group">
                            <input type="text" class="form-control js-reg-id" name="user_id" placeholder="아이디" required style="padding-right: 100px;" />
                            <a href="#" class="btn btn-warning js-btn-duplicate">중복검사</a>
                        </div>

                        <div class="form-group" style="padding: 10px 0;">
                            <input type="password" class="form-control js-reg-pw" name="password" placeholder="비밀번호" required />

                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control js-reg-pw2" name="password2" placeholder="비밀번호(확인)" required />
                        </div>

                        <div style="height:2px;background:#e2e2e2;margin-top: 50px;"></div>

                        <div style="margin-top: 40px;">
                            <h4 class="section-title-m">개인정보취급방침</h4>
                            <div class="privacy-box-m">
                                <div style="white-space: pre-line;"><?php echo html_entity_decode($info[0]['privacy']);?></div>
                            </div>

                            <div style="margin-top: 5px;">
                                <input type="checkbox" id="privacy_agree" required checked class="js-reg-privacy" />
                                <label for="privacy_agree">위의 사항에 모두 동의합니다.</label>
                            </div>
                        </div>

                        <div style="margin-top: 15px;">
                            <h4 class="section-title-m">이용약관</h4>

                            <div class="privacy-box-m">
                                <div style="white-space: pre-line;line-height: 22px;"><?php echo html_entity_decode($info[0]['agreement']);?></div>
                            </div>

                            <div style="margin-top: 5px;">
                                <input type="checkbox" id="agreement_agree" required checked class="js-reg-agreement" />
                                <label for="agreement_agree">위의 사항에 모두 동의합니다.</label>
                            </div>
                        </div>

                        <div style="margin-top: 40px;text-align: center;">
                            <button type="submit" class="btn btn-primary js-btn-register btn-register-pc">
                                한국경제투자TV 회원가입
                            </button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>

    <?php require_once ('./inc/vt-footer.php');?>


<?php } ?>



<?php require_once ('./inc/foot.php');?>
<script>
    (function ($){

    }(jQuery));

    var submitBtn=$('.js-btn-register');
    var btnDupId=$('.js-btn-duplicate');
    var form=$('.form-register');

    var js_reg_name=$('.js-reg-name');
    var js_reg_phone=$('.js-reg-phone');
    var js_reg_email=$('.js-reg-email');

    var js_reg_id=$('.js-reg-id');
    var js_reg_pw=$('.js-reg-pw');
    var js_reg_pw2=$('.js-reg-pw2');

    var js_reg_privacy=$('.js-reg-privacy');
    var js_reg_agreement=$('.js-reg-agreement');

    var is_duplicated=true;


    submitBtn.bind('click', function (e){
        e.preventDefault();

        if(js_reg_name.val().trim() === ''){
            alert('이름을 입력해 주세요.');
            return;
        }

        if(js_reg_phone.val().trim() === ''){
            alert('휴대전화번호를 입력해 주세요.');
            return;
        }

        if(js_reg_email.val().trim() === ''){
            alert('이메일을 입력해 주세요.');
            return;
        }

        if(js_reg_id.val().trim() === ''){
            alert('아이디를 입력해 주세요.');
            return;
        }

        if(is_duplicated === true){
            alert('아이디 중복검사를 진행하세요.');
            return;
        }

        if(js_reg_pw.val().trim() === ''){
            alert('비밀번호를 입력해 주세요.');
            return;
        }

        if(js_reg_pw.val().trim().length < 4){
            alert('비밀번호는 4자리 이상 입력해주세요.');
            return;
        }

        if(js_reg_pw2.val().trim() === ''){
            alert('비밀번호(확인)를 입력해 주세요.');
            return;
        }

        if( js_reg_pw.val().trim() !== js_reg_pw2.val().trim() ){
            alert('비밀번호가 일치하지 않습니다.');
            return;
        }


        if(js_reg_privacy.prop('checked') === false){
            alert('개인정보취급방침에 동의해 주세요.');
            return;
        }

        if(js_reg_agreement.prop('checked') === false){
            alert('이용약관에 동의해 주세요.');
            return;
        }


        form.submit();
    });

    btnDupId.bind('click', function (e) {
        e.preventDefault();

        var _user_id=$('.js-reg-id').val().trim();

        if(_user_id === ''){
            alert('아이디를 입력하세요.');
            return;
        }

        $.ajax({
            type: "POST",
            url: "/api/customer/check_duplication.php",
            data: {
                user_id: _user_id
            },
            dataType: 'json',
        }).done(function(res){

            console.info(res);

            if(res.result[0]['total'] > 0){
                alert('사용할 수 없는 아이디입니다.');
                is_duplicated=true;
            }else if(res.result[0]['total'] === "0"){
                alert('사용할 수 있는 아이디입니다.');
                is_duplicated=false;
            }


        }).fail(function (xhr, status, error){
            console.info(xhr);
            console.info(status);
            console.info(error);
        });
    });



</script>
</body>
</html>