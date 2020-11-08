<?php

require_once ('../../autoload.php');
require_once('../../commons/config.php');
require_once('../../commons/utils.php');
require_once('../../commons/session.php');
define('PAGE','EMPLOYEE');


if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo(ROOT . 'login.php', '로그인이 필요합니다.');
    exit;
}

if($_SESSION['role'] !== '1'){
    AlertMsgAndRedirectTo(ROOT . 'index.php', '최고관리자만 접근할 수 있는 페이지입니다.');
    exit;
}

use JCORP\Database\DBConnection as DBconn;
$db = new DBconn();

$company_id=getCompanyId();

// 권한 리스트 가져오기
$query_role="select * from `platform_role` where `company_id`=$company_id;";
$roles=$db->query($query_role);

$db=null;

?>


<?php require_once ('../inc/head.php');?>

<body class="fix-header fix-sidebar">
<!-- Preloader - style you can find in spinners.css -->
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
</div>
<!-- Main wrapper  -->
<div id="main-wrapper">
    <?php require_once ('../inc/header.php');?>
    <?php require_once ('../inc/leftmenu.php');?>

    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">직원관리</h3></div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">직원관리</li>
                </ol>
            </div>
        </div>
        <!-- End Bread crumb -->

        <!-- Container fluid  -->
        <div class="container-fluid">
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card" style="max-width: 800px;margin: 0 auto;">
                        <div class="card-title clearfix">
                            <h4>직원생성</h4>
                            <a href="<?php echo ROOT;?>admin/employee/" class="btn btn-outline-primary pull-right">뒤로</a>
                        </div>
                        <div class="card-body">
                            <!-- 직원생성 -->
                            <div class="form-validation">
                                <form class="form-valide" action="<?php echo ROOT;?>admin/employee/response/res_create.php" method="post">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-username">이름 <span class="text-danger">*</span></label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="val-username" name="val-username" placeholder="직원 이름" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-account">로그인계정 <span class="text-danger">*</span></label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="val-account" name="val-account" placeholder="로그인 계정 아이디" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-password">비밀번호 <span class="text-danger">*</span></label>
                                        <div class="col-lg-6">
                                            <input type="password" class="form-control" id="val-password" name="val-password" placeholder="비밀번호" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-role">권한 <span class="text-danger">*</span></label>
                                        <div class="col-lg-6">
                                            <select class="form-control" id="val-role" name="val-role">
                                                <option value="">권한선택</option>
                                                <?php for($r=0,$r_size=count($roles);$r<$r_size;$r++){ ?>
                                                    <option value="<?php echo $roles[$r]['id']; ?>"><?php echo $roles[$r]['role_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-phone">전화번호 <span class="text-danger">*</span></label>
                                        <div class="col-lg-6">
                                            <input type="text"
                                                   class="form-control"
                                                   id="val-phone"
                                                   name="val-phone"
                                                   maxlength="13"
                                                   placeholder="전화번호 (-포함)" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-8 ml-auto">
                                            <button type="submit" class="btn btn-info">직원생성</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- // 직원생성 -->
                        </div>
                    </div>
                    <!-- /# card -->
                </div>
            </div>
            <!-- /# row -->
            <!-- End PAge Content -->
        </div>
        <!-- End Container fluid  -->

        <?php require_once ('../inc/footer.php'); ?>
        <?php require_once ('../modal/modal_modify_pass.php'); ?>
    </div>
    <!-- End Page wrapper  -->
</div>
<!-- End Wrapper -->

<?php require_once ('../inc/foot.php'); ?>
<script src="<?php echo ROOT;?>/assets/js/lib/form-validation/jquery.validate-init.js"></script>
</body>
</html>