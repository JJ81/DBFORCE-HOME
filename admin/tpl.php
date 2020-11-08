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

use JCORP\Business\Profit\ProfitService as Profit;
$profit=new Profit();
$company_id=$_SESSION['company_id'];

// pagination!!
if(empty($_GET['size'])){
    $size=20;
}else{
    $size=getDataByGet('size');
}

if(empty($_GET['page'])){
    $page=1;
}else{
    $page=getDataByGet('page');
}

$current=$page;
$next=null;
$prev=null;

// get total count
$total=$profit->getTotalCount();
$total_count = $total[0]['total'];
$total_page=ceil($total_count/$size);
$offset=($page-1)*$size;

if($current < $total_page){
    $next = $current+1;
} else {
    $next=$current;
}

if($current > 1){
    $prev = $current-1;
}else{
    $prev=$current;
}

$rows=$profit->getList($offset, $size);
error_log(print_r($rows, true));

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
                            <h4><?php echo PAGENAME;?></h4>
                            <a href="<?php echo ROOT;?>admin/<?php echo TARGET_FOLDER;?>/write.php" class="btn btn-outline-info pull-right">글쓰기</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                


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
    // Ajax를 통한 글 삭제 처리
    var btnDelete=$('.js-delete-notice');
    btnDelete.bind('click', function (e) {
        e.preventDefault();
        var _notice_id=$(this).attr('data-notice-id');
        console.info(_notice_id);

        // sweetalert dialogue opens
        swal({
            title: '선택하신 게시물을 삭제하시겠습니까?',
            text: "선택된 정보는 삭제되어 복원될 수 없습니다.",
            icon: "warning",
            buttons: [
                '아니오', '예'
            ],
            dangerMode: true
            // type: 'warning',
            // showCancelButton: true,
            // confirmButtonColor: '#3085d6',
            // cancelButtonColor: '#d33',
            // confirmButtonText: 'Okay'
        }).then(function(isConfirm) {
            if(isConfirm){
                axios.get('/api/profit/delete_profit_by_id.php?id=' + _notice_id)
                    .then(function (res) {
                        if(res.data.success){
                            swal(
                                '삭제!',
                                '게시물이 삭제되었습니다.',
                                'success'
                            );
                            window.location.reload();
                        }else{
                            swal(
                                '실패!',
                                '선택하신 게시물을 삭제할 수 없습니다.',
                                'warning'
                            );
                        }
                    })
                    .catch(function (err){
                        console.error(err);
                    });
            }
        });
    });

    // 메인 설정
    $('.js-set-main').bind('click', function(e){
        e.preventDefault();
        // 설정 창을 띄운다.
        var news_id=$(this).attr('data-news-id');
        var modal=$('#modalSetMainNews');

        modal.find('.js-news-id').val(news_id);
        modal.modal('show');
    });

    // 메인 해제
    $('.js-remove-main').bind('click', function (e){
        e.preventDefault();
        // ajax를 통해서 해제처리를 한다.
        var news_id=$(this).attr('data-news-id');
        if(news_id === ''){
            return;
        }

        axios.get('/api/profit/remove_from_main_by_id.php?id=' + news_id)
            .then(function (res) {
                if(res.data.success){
                    swal(
                        '노출해제',
                        '게시물이 메인에 노출 해제되었습니다.',
                        'success'
                    );
                    window.location.reload();
                }else{
                    swal(
                        '노출해제',
                        '게시물이 메인에 노출 해제되지 않았습니다.',
                        'warning'
                    );
                }
            })
            .catch(function (err) {
                console.info(err);
                swal(
                    '[에러] 노출해제',
                    '게시물이 메인에 노출 해제되지 않았습니다.',
                    'warning'
                );
            });

    });

</script>
</body>
</html>