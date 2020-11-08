<?php
require_once ('../../autoload.php');
require_once('../../commons/config.php');
require_once('../../commons/utils.php');
require_once('../../commons/session.php');
define('PAGE','CUSTOMER');

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/login.php', '로그인이 필요합니다.');
    exit;
}

use JCORP\Database\DBConnection as DBconn;
$db=new DBconn();

$image=$db->query("select * from `jp_ld_image` order by `id` desc limit 0,1;");


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
                <h3 class="text-primary">이미지관리</h3></div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">이미지관리</li>
                </ol>
            </div>
        </div>
        <!-- End Bread crumb -->

        <!-- Container fluid  -->
        <div class="container-fluid" id="vueStatus">
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-title clearfix">
                            <h4>이미지관리 <small>(* 현재 랜딩페이지 이미지를 교체하기 위한 요청에 의한 기능입니다.)</small></h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php if(count($image) == 0){ ?>
                                    아직 등록된 이미지가 없습니다.
                                <?php }else{ ?>
                                    <img src="<?php echo ROOT;?>assets/img/<?php echo $image[0]['image_name']; ?>"
                                         alt=""
                                         style="width: 100%;" />
                                <?php } ?>
                            </div>

                            <div style="padding: 20px;border: 1px solid #ddd;border-radius: 10px;margin-top: 20px;">
                                <form action="<?php echo ROOT;?>admin/image/response/res_register_img.php" method="post" enctype="multipart/form-data">
                                    <p><small>*jpg, jpeg만 허용합니다.</small></p>
                                    <input type="file" name="file" accept="image/jpg, image/jpeg" required />
                                    <button type="submit" class="btn btn-outline-success">등록/변경</button>
                                </form>
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

<?php require_once ('../inc/foot.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.22/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>

</body>
</html>