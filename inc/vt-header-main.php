<div style="background: url('<?php echo ROOT;?>assets/img/banner/pc/top-ban-prize.png') no-repeat center 0;height: 90px;"></div>
<div class="jp-header">
    <div class="jp-header-inner">
        <h1 class="jp-logo">
            <a href="/">
                <img src="<?php echo ROOT;?>assets/img/common/logo-common.png" alt="" width="250" />
            </a>
        </h1>

        <?php if(empty($_SESSION['user_uuid'])){ ?>
            <a href="./login.php" class="btn-login-pc-top">로그인</a>
            <a href="./register.php" class="btn-reg-pc-top">회원가입</a>
        <?php }else{ ?>
            <a href="<?php echo ROOT;?>response/res_logout.php" class="btn-reg-pc-top">로그아웃</a>
        <?php } ?>

<!--        <a href="--><?php //echo EVENT_PAGE_URL;?><!--" class="btn-event-top-ban" target="_blank">-->
<!--            <img src="--><?php //echo ROOT;?><!--assets/img/pc/img-pc-top-ban.png" alt="" width="230" />-->
<!--        </a>-->

    </div>

    <?php require_once ('./inc/navigation.php');?>

    <div class="jp-login-nav-area blind">
        <div class="jp-login-nav-area-inner">
<!--            <form action="--><?php //echo ROOT;?><!--response/res_login.php" method="post">-->
<!--                <label for="login_id">아이디</label>-->
<!--                <input type="text" name="user_id" id="login_id" class="form-control input-pc-user-id" required placeholder="아이디" />-->
<!--                &nbsp;-->
<!--                <label for="password">비밀번호</label>-->
<!--                <input type="password" name="password" id="password" class="form-control input-pc-user-pw" required placeholder="비밀번호" />-->
<!--                &nbsp;-->
<!--                <button type="submit" class="btn-pc-login">-->
<!--                    <img src="--><?php //echo ROOT;?><!--assets/img/pc/btn-login-top.jpg" alt="" />-->
<!--                </button>-->
<!--                <a href="./register.php" class="btn-pc-register">-->
<!--                    <img src="--><?php //echo ROOT;?><!--assets/img/pc/btn-register-top.jpg" alt="" />-->
<!--                </a>-->
<!--            </form>-->
        </div>
    </div>
</div>