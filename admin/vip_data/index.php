<?php
require_once ('../../autoload.php');
require_once('../../commons/config.php');
require_once('../../commons/utils.php');
require_once('../../commons/session.php');

define('PAGE','VIP');
define('PAGENAME', 'VIP데이터관리');
define('TARGET_FOLDER', 'vip');

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/login.php', '로그인이 필요합니다.');
    exit;
}

$company_id=$_SESSION['company_id'];

use \JCORP\Business\VIP\VIPService as VIP;
$vip=new VIP();

// VIP 리스트 가져오기
$rows=$vip->getListBySize(20);

// 누적 VIP수 가져오기
$vip_total=$vip->totalVIPAmount();

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
                            <h4 class="clearfix" style="display: block;">
                                <?php echo PAGENAME;?>
<!--                                <div class="pull-right">-->
<!--                                    <strong>누적 VIP</strong>&nbsp;&nbsp;-->
<!--                                    <input type="text"-->
<!--                                           class="form-control js-input-vip-amount"-->
<!--                                           value="--><?php //echo $vip_total[0]['count'];?><!--"-->
<!--                                           style="display: inline-block;width: 100px;text-align: right;" />-->
<!--                                    <button class="btn btn-warning js-btn-update-vip-amount">업데이트</button>-->
<!--                                </div>-->

                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form method="post" action="./response/res_vip_update.php">
                                    <table class="table">
                                        <colgroup>
                                            <col width="100" />
                                            <col width="*" />
                                            <col width="*" />
                                            <col width="*" />
                                        </colgroup>
                                        <thead>
                                        <tr>
                                            <th>순서</th>
                                            <th>이름</th>
                                            <th>전화번호 뒷자리</th>
                                            <th>
                                                <button class="btn btn-primary"
                                                        type="submit">전체 업데이트</button>
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
                                                       value="<?php echo $rows[$i]['vid'];?>" />
                                            </td>
                                            <td>
                                                <input type="text"
                                                       class="form-control"
                                                       name="name[]"
                                                       required
                                                       value="<?php echo $rows[$i]['user_name'];?>" />
                                            </td>
                                            <td>
                                                <input type="text"
                                                       class="form-control"
                                                       name="tel_end[]"
                                                       required
                                                       value="<?php echo $rows[$i]['tel_end'];?>" />
                                            </td>
                                            <td> - </td>
                                        </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
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
<?php require_once ('../modal/modal_set_expose_news.php'); ?>
<?php require_once ('../inc/foot.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
<script>
    // 누적 VIP 수정
    $('.js-btn-update-vip-amount').bind('click', function (e) {
        e.preventDefault();
        var _target=$('.js-input-vip-amount');
        var _val=_target.val().trim();

        if(!_val || _val === ''){
            alert('값을 정확하게 입력해 주세요.');
            return;
        }

        axios.get('/api/vip/set_vip_amount.php?count=' + _val)
            .then(function (res) {
                if(res.data.success){
                    axios.get('/api/vip/get_vip_amount.php')
                        .then(function(res){
                            swal(
                                '[성공] VIP Total Amount',
                                '수정되었습니다.',
                                'success'
                            );
                        })
                        .catch(function (err) {
                            console.error(err);
                            window.location.reload();
                        });
                }else{
                    window.location.reload();
                }
            })
            .catch(function (err) {
                console.info(err);

                swal(
                    '[에러] VIP Total Amount',
                    '수정되지 않았습니다.',
                    'warning'
                );
            });
    });

</script>
</body>
</html>