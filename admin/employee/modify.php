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

if(empty($_GET['employee_id'])){
    AlertMsgAndRedirectTo(ROOT . 'employee/', '잘못된 접근입니다.');
    exit;
}

$company_id=getCompanyId();
$employee_id=getDataByGet('employee_id');

use JCORP\Database\DBConnection as DBconn;
$db = new DBconn();


// 직원 정보 검색
$query_employee="select * from `platform_employee` where `id`=$employee_id and `company_id`=$company_id;";
$employee=$db->query($query_employee);

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
                            <h4>직원정보 수정</h4>
                            <a href="<?php echo ROOT;?>admin/employee/" class="btn btn-outline-primary pull-right">뒤로</a>
                        </div>
                        <div class="card-body">
                            <!-- 직원생성 -->
                            <div class="form-validation">
                                <form class="form-valide" action="<?php echo ROOT;?>admin/employee/response/res_modify.php" method="post">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-username">이름 <span class="text-danger">*</span></label>
                                        <div class="col-lg-6">
                                            <input type="text"
                                                   class="form-control"
                                                   id="val-username"
                                                   name="val-username"
                                                   value="<?php echo $employee[0]['name']; ?>"
                                                   placeholder="직원 이름" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-account">로그인계정 <span class="text-danger">*</span></label>
                                        <div class="col-lg-6">
                                            <input type="text"
                                                   class="form-control"
                                                   id="val-account"
                                                   name="val-account"
                                                   value="<?php echo $employee[0]['login_id']; ?>"
                                                   <?php if($employee[0]['role_id'] === "1"){ echo 'readonly';} ?>
                                                   placeholder="로그인 계정 아이디" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-role">권한 <span class="text-danger">*</span></label>
                                        <div class="col-lg-6">
                                            <?php if($employee[0]['role_id'] === "1"){ ?>
                                                <select class="form-control" id="val-role" name="val-role" readonly>
                                                    <option value="1">최고관리자</option>
                                                </select>
                                            <?php }else{ ?>
                                                <select class="form-control" id="val-role" name="val-role">
                                                    <option value="">권한선택</option>
                                                    <?php for($r=0,$r_size=count($roles);$r<$r_size;$r++){ ?>
                                                        <option value="<?php echo $roles[$r]['id']; ?>" <?php if($roles[$r]['id'] == $employee[0]['role_id']){ echo 'selected';} ?>>
                                                            <?php echo $roles[$r]['role_name']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <?php if($employee[0]['role_id'] !== "1"){ ?>

                                    <?php } ?>

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-phone">전화번호 <span class="text-danger">*</span></label>
                                        <div class="col-lg-6">
                                            <input type="text"
                                                   class="form-control"
                                                   maxlength="13"
                                                   id="val-phone"
                                                   name="val-phone"
                                                   value="<?php echo $employee[0]['phone']; ?>"
                                                   placeholder="전화번호입력 (-포함)" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-8 ml-auto">
                                            <button type="submit" class="btn btn-warning">직원정보수정</button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>" />
<!--                                    <input type="hidden" name="val-account" value="--><?php //echo $employee[0]['login_id']; ?><!--" />-->
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