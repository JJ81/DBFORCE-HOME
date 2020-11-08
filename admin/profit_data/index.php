<?php
require_once ('../../autoload.php');
require_once('../../commons/config.php');
require_once('../../commons/utils.php');
require_once('../../commons/session.php');

define('PAGE','PROFIT_DATA');
define('PAGENAME', '수익율데이터관리');
define('TARGET_FOLDER', 'profit_data');

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/login.php', '로그인이 필요합니다.');
    exit;
}

$company_id=$_SESSION['company_id'];

use JCORP\Business\Profit\ProfitService as Profit;
$profit=new Profit();

// 누적 수익율
$rows=$profit->getProfitAccumulation();

// 월간 수익율
$rows2=$profit->getProfitByMonth();

// 주간 수익율
$rows3=$profit->getProfitByWeek();

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
                <h3 class="text-primary"><?php echo PAGENAME;?></h3></div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active"><?php echo PAGENAME;?></li>
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
                            <h4 class="clearfix">
                                <?php echo PAGENAME;?>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="rows">
                                <div class="col-md-12">
                                    <form method="post" action="./response/res_free_update.php">
                                        <table class="table">
                                            <colgroup>
                                                <col width="100" />
                                                <col width="*" />
                                                <col width="*" />
                                            </colgroup>
                                            <thead>
                                            <tr>
                                                <th>순서</th>
                                                <th>누적수익율</th>
                                                <th>
                                                    <button class="btn btn-primary">업데이트</button>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php for($i=0,$size=count($rows);$i<$size;$i++){ ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $i+1;?>
                                                        <input type="hidden"
                                                               name="id[]"
                                                               value="<?php echo $rows[$i]['id'];?>" />
                                                    </td>
                                                    <td>
                                                        <input type="text"
                                                               class="form-control"
                                                               name="name[]"
                                                               required
                                                               value="<?php echo $rows[$i]['name'];?>" />
                                                    </td>
                                                    <td>
                                                        <input type="text"
                                                               class="form-control"
                                                               name="percentage[]"
                                                               required
                                                               value="<?php echo $rows[$i]['percentage'];?>" />
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>

                                <br />

                                <div class="col-md-12">
                                    <form method="post" action="./response/res_free_update2.php">
                                        <table class="table">
                                            <colgroup>
                                                <col width="100" />
                                                <col width="*" />
                                                <col width="*" />
                                            </colgroup>
                                            <thead>
                                            <tr>
                                                <th>순서</th>
                                                <th>월간수익율</th>
                                                <th>
                                                    <button class="btn btn-primary">업데이트</button>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php for($i=0,$size=count($rows2);$i<$size;$i++){ ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $i+1;?>
                                                        <input type="hidden"
                                                               name="id[]"
                                                               value="<?php echo $rows2[$i]['id'];?>" />
                                                    </td>
                                                    <td>
                                                        <input type="text"
                                                               class="form-control"
                                                               name="name[]"
                                                               required
                                                               value="<?php echo $rows2[$i]['name'];?>" />
                                                    </td>
                                                    <td>
                                                        <input type="text"
                                                               class="form-control"
                                                               name="percentage[]"
                                                               required
                                                               value="<?php echo $rows2[$i]['percentage'];?>" />
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>

                                <br />

                                <div class="col-md-12">
                                    <form method="post" action="./response/res_free_update3.php">
                                        <table class="table">
                                            <colgroup>
                                                <col width="100" />
                                                <col width="*" />
                                                <col width="*" />
                                            </colgroup>
                                            <thead>
                                            <tr>
                                                <th>순서</th>
                                                <th>주간수익율</th>
                                                <th>
                                                    <button class="btn btn-primary">업데이트</button>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php for($i=0,$size=count($rows3);$i<$size;$i++){ ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $i+1;?>
                                                        <input type="hidden"
                                                               name="id[]"
                                                               value="<?php echo $rows3[$i]['id'];?>" />
                                                    </td>
                                                    <td>
                                                        <input type="text"
                                                               class="form-control"
                                                               name="name[]"
                                                               required
                                                               value="<?php echo $rows3[$i]['name'];?>" />
                                                    </td>
                                                    <td>
                                                        <input type="text"
                                                               class="form-control"
                                                               name="percentage[]"
                                                               required
                                                               value="<?php echo $rows3[$i]['percentage'];?>" />
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
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
<?php require_once ('../modal/modal_set_expose_news.php'); ?>
<?php require_once ('../inc/foot.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
</body>
</html>