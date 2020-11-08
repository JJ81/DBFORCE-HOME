<?php
require_once ('../../autoload.php');
require_once('../../commons/config.php');
require_once('../../commons/utils.php');
require_once('../../commons/session.php');
define('PAGE','CUSTOMER');
define('PAGE_NAME', "템플릿관리");

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/login.php', '로그인이 필요합니다.');
    exit;
}
use \JCORP\Business\Template\TemplateService as Template;
$template=new Template();

$size=null;
$page=null;
$prev=null;
$next=null;
$total_page=null;

$admin_id=$_SESSION['user_id'];
$company_id=$_SESSION['company_id'];

$rows=$template->getTemplate($company_id, 0, 1000);

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
                            <a href="./create.php" class="btn btn-outline-primary pull-right">템플릿 생성</a>
                        </div>
                        <div class="card-body" id="vue-customer-table">
                            <div class="table-responsive jp-customer-table">
                                <table class="display nowrap table table-hover table-bordered jp-table-customer" cellspacing="0" width="100%">
                                    <colgroup>
                                        <col width="150" />
                                        <col width="150" />
                                        <col width="*" />
                                        <col width="*" />
                                        <col width="100" />
                                        <col width="150" />
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th class="center">등록일</th>
                                        <th class="center">유형</th>
                                        <th class="center">템플릿명</th>
                                        <th class="center">설명</th>
                                        <th class="center">상태</th>
                                        <th>액션</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(count($rows) === 0){ ?>
                                        <tr>
                                            <td colspan="6" class="center">No Data.</td>
                                        </tr>
                                    <?php } else { ?>
                                        <?php for($i=0,$size=count($rows);$i<$size;$i++){ ?>
                                        <tr class="jp-customer-record">
                                            <td class="center">
                                                <?php echo $rows[$i]['created_dt'] ;?>
                                            </td>
                                            <td class="center">
                                                <?php
                                                    if($rows[$i]['template_type'] === 'IM'){
                                                        echo "이미지형";
                                                    } else if($rows[$i]['template_type'] === 'BD'){
                                                        echo "게시판형";
                                                    } else if($rows[$i]['template_type'] === 'HM'){
                                                        echo "HTML형";
                                                    }
                                                ?>
                                            </td>
                                            <td class="center">
                                                <?php echo $rows[$i]['title'] ;?>
                                            </td>
                                            <td class="center">
                                                <?php
                                                    if(empty($rows[$i]['purpose'])){
                                                        echo "-";
                                                    }else{
                                                        echo $rows[$i]['purpose'];
                                                    }
                                                ?>
                                            </td>
                                            <td class="center">
                                                <?php
                                                    if($rows[$i]['isOpen'] == "1"){
                                                        echo "활성화";
                                                    }else {
                                                        echo "비활성화";
                                                    }
                                                ?>
                                            </td>
                                            <td class="center">
                                                <a href="./modify.php" class="btn btn-sm btn-outline-warning">보기</a>
                                                <button type="button" class="btn btn-sm btn-outline-danger">삭제</button>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                    </tbody>
                                </table>

                                <?php if(count($rows) !== 0){ ?>
                                    <nav style="margin-top: 20px; display: none;">
                                        <ul class="pagination">
                                            <li class="page-item">
                                                <a class="page-link"
                                                   href="<?php echo ROOT;?>/admin/customer/?size=<?php echo $size;?>&page=1&name=<?php echo $name;?>&phone=<?php echo $phone;?>&status=<?php echo $status;?>"
                                                   tabindex="-1">First</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link"
                                                   href="<?php echo ROOT;?>admin/customer/?size=<?php echo $size;?>&page=<?php echo $prev;?>&name=<?php echo $name;?>&phone=<?php echo $phone;?>&status=<?php echo $status;?>"
                                                   tabindex="-1">Previous</a>
                                            </li>
                                            <li class="page-item">
                                            <span class="page-link">
                                                <strong style="color: #1e91e4;"><?php echo $current; ?></strong> / <?php echo $total_page; ?>
                                            </span>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link"
                                                   href="<?php echo ROOT;?>admin/customer/?size=<?php echo $size;?>&page=<?php echo $next;?>&name=<?php echo $name;?>&phone=<?php echo $phone;?>&status=<?php echo $status;?>"
                                                   tabindex="-1">Next</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link"
                                                   href="<?php echo ROOT;?>admin/customer/?size=<?php echo $size;?>&page=<?php echo $total_page;?>&name=<?php echo $name;?>&phone=<?php echo $phone;?>&status=<?php echo $status;?>"
                                                   tabindex="-1">Last</a>
                                            </li>
                                        </ul>
                                    </nav>
                                <?php } ?>
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