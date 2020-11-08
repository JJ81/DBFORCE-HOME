<?php
require_once ('../../autoload.php');
require_once('../../commons/config.php');
require_once('../../commons/utils.php');
require_once('../../commons/session.php');
define('PAGE','CUSTOMER');
define('PAGE_NAME', "캠페인관리");

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/login.php', '로그인이 필요합니다.');
    exit;
}

$admin_id=$_SESSION['user_id'];
$company_id=$_SESSION['company_id'];

use \JCORP\Business\Campaign\CampaignService as Campaign;
$campaign=new Campaign();

$rows=$campaign->getCampaign($company_id, 0, 1000);

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
                <h3 class="text-primary"><?php echo PAGE_NAME;?></h3></div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active"><?php echo PAGE_NAME;?></li>
                </ol>
            </div>
        </div>
        <!-- End Bread crumb -->

        <!-- Container fluid  -->
        <div class="container-fluid">
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-title clearfix">
                            <h4><?php echo PAGE_NAME;?></h4>
                            <a href="./create.php" class="btn btn-outline-primary pull-right">캠페인 생성</a>
                        </div>
                        <div class="card-body" id="vue-customer-table">
                            <div class="table-responsive jp-customer-table">
                                <table class="display nowrap table table-hover table-bordered jp-table-customer" cellspacing="0" width="100%">
                                    <colgroup>
                                        <col width="150">
                                        <col width="*">
                                        <col width="120">
                                        <col width="*">
                                        <col width="250">
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th class="center">등록일</th>
                                        <th class="center">캠페인명</th>
                                        <th class="center">상태</th>
                                        <th class="center">목적</th>
                                        <th>액션</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(count($rows) === 0){ ?>
                                        <tr>
                                            <td colspan="5" class="center">No Data.</td>
                                        </tr>
                                        <?php } else { ?>
                                            <?php for($i=0,$size=count($rows);$i<$size;$i++){ ?>
                                            <tr>
                                                <td>
                                                    <?php echo $rows[$i]['created_dt'];?>
                                                </td>
                                                <td>
                                                    <?php echo $rows[$i]['title'];?>
                                                </td>
                                                <td class="center">
                                                    <?php if($rows[$i]['isOpen'] === "1"){ ?>
                                                        <span class="badge badge-info">활성화</span>
                                                    <?php } else { ?>
                                                        <span class="badge badge-danger">비활성화</span>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php echo $rows[$i]['purpose'];?>
                                                </td>
                                                <td>
                                                    <a href="#" target="_blank" class="btn btn-sm btn-outline-primary">미리보기</a>
                                                    <button type="button" class="btn btn-sm btn-outline-info">활성화</button>
                                                    <a href="./modify.php" class="btn btn-sm btn-outline-warning">수정</a>
                                                    <button type="button" class="btn btn-sm btn-outline-danger">삭제</button>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>

                            </div>
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
    </div>
    <!-- End Page wrapper  -->
</div>
<!-- End Wrapper -->
<?php require_once ('../modal/modal_modify_pass.php'); ?>
<?php require_once ('../modal/modal_modify_customer.php'); ?>
<?php require_once ('../modal/modal_delete_customer.php'); ?>
<?php require_once ('../modal/modal_view_memo.php'); ?>
<?php require_once ('../modal/modal_memo.php'); ?>
<?php require_once ('../modal/modal_device_info.php'); ?>

<?php require_once ('../inc/foot.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.22/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="<?php echo ROOT;?>admin/assets/vue/vue.common.js?v=<?php echo VERSION;?>"></script>

</body>
</html>