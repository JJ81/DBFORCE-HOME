<?php
require_once('../commons/config.php');
require_once('../commons/utils.php');
require_once('../commons/session.php');
define('PAGE','LOGIN');

if (!empty($_SESSION['user'])){
    Redirect(ROOT . 'admin/');
    exit;
}

?>

<?php require_once ('./inc/head.php');?>

<body class="fix-header fix-sidebar">
<!-- Preloader - style you can find in spinners.css -->
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
</div>
<!-- Main wrapper  -->
<div id="main-wrapper">

    <div class="unix-login">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="login-content card">
                        <div class="login-form">
                            <h4 style="text-align: center;font-size: 30px;">
                                <img src="<?php echo ROOT;?>assets/img/mobile/logo.png" alt="" />
                            </h4>
                            <form action="/admin/response/res_login.php" method="post">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="user" placeholder="User ID" autofocus required />
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="pass" placeholder="Password" required />
                                </div>
                                <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30"
                                        style="font-weight: bold;font-size: 16px;">로그인</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- End Wrapper -->

<?php require_once ('./inc/foot.php'); ?>
<script>
    var agent = navigator.userAgent.toLowerCase();

    if (agent.indexOf('chrome') == -1) {
        alert('관리자 시스템은 크롬기반의 브라우저로 접속해 주세요.')
    }

</script>
</body>

</html>