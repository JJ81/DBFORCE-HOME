<?php
require_once ('../../autoload.php');
require_once('../../commons/config.php');
require_once('../../commons/utils.php');
require_once('../../commons/session.php');

define('PAGE','MEMBER');
define('PAGENAME', '회원관리');
define('TARGET_FOLDER', 'member');

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/login.php', '로그인이 필요합니다.');
    exit;
}

use JCORP\Business\MemberService\MemberService as Member;
$inc=new Member();
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
$total=$inc->getTotalCount();
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

$rows=$inc->getList($offset, $size);
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
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <colgroup>
                                        <col width="150" />
                                        <col width="*" />
                                        <col width="*" />
                                        <col width="*" />
                                        <col width="*" />
                                        <col width="150" />
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th class="center">#ID</th>
                                        <th class="center">이름</th>
                                        <th class="center">전화번호</th>
                                        <th class="center">이메일</th>
                                        <th class="center">가입일</th>
                                        <th class="center">액션</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(count($rows) == 0){ ?>
                                        <tr>
                                            <td colspan="6">No Data.</td>
                                        </tr>
                                    <?php }else{ ?>
                                        <?php foreach ($rows as $r) { ?>
                                            <tr>
                                                <th scope="row" class="center"><?php echo $r['id'];?></th>
                                                <td class="color-primary center">
                                                    <?php echo replaceQuotationMark($r['name']);?>
                                                </td>
                                                <td class="center">
                                                    <?php echo $r['phone'];?>
                                                </td>
                                                <td class="center">
                                                    <?php echo $r['email'];?>
                                                </td>
                                                <td class="center">
                                                    <?php echo setDate($r['created_dt']);?>
                                                </td>
                                                <td class="center">
                                                    <!-- TODO 비밀번호 리셋 기능 처리 -->
                                                    <a href="#" data-notice-id="<?php echo $r['id'];?>" class="btn btn-sm btn-outline-warning js-reset-pw">비밀번호리셋</a>
                                                    <a href="#" data-notice-id="<?php echo $r['id'];?>" class="btn btn-sm btn-outline-danger js-delete-board">삭제</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>

                                    </tbody>
                                </table>

                                <?php if(count($rows) !== 0){ ?>
                                    <nav class="clearfix" style="margin-top: 20px;position: relative;" >
                                        <ul class="pagination pull-left">
                                            <li class="page-item">
                                                <a class="page-link"
                                                   href="<?php echo ROOT;?>admin/<?php echo TARGET_FOLDER;?>/?size=<?php echo $size;?>&page=1" tabindex="-1">First</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link"
                                                   href="<?php echo ROOT;?>admin/<?php echo TARGET_FOLDER;?>/?size=<?php echo $size;?>&page=<?php echo $prev;?>" tabindex="-1">Previous</a>
                                            </li>
                                            <li class="page-item">
                                            <span class="page-link">
                                                <strong style="color: #1e91e4;"><?php echo $current; ?></strong> / <?php echo $total_page; ?>
                                            </span>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link"
                                                   href="<?php echo ROOT;?>admin/<?php echo TARGET_FOLDER;?>/?size=<?php echo $size;?>&page=<?php echo $next;?>">Next</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link"
                                                   href="<?php echo ROOT;?>admin/<?php echo TARGET_FOLDER;?>/?size=<?php echo $size;?>&page=<?php echo $total_page;?>" tabindex="-1">Last</a>
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
<?php require_once ('../inc/foot.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
<script>
    // Ajax를 통한 글 삭제 처리
    var btnDelete=$('.js-delete-board');
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
                axios.get('/api/member_profit/delete_board_by_id.php?id=' + _notice_id)
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
</script>
</body>
</html>