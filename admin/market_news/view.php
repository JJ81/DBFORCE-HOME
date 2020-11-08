<?php

require_once('../../autoload.php');
require_once('../../commons/config.php');
require_once('../../commons/utils.php');
require_once('../../commons/session.php');

define('PAGE','NOTICE');
define('PAGENAME', '그룹소개');
define('TARGET_FOLDER', 'notice');

if(empty($_GET['id'])){
    AlertMsgAndRedirectTo(ROOT . 'admin/notice/', '잘못된 접근입니다');
    exit;
}

$id=getDataByGet('id');
use JCORP\Business\Notice\NoticeService as Notice;
$notice=new Notice();
$company_id=$_SESSION['company_id'];
$row=$notice->getListById($id);

if(count($row) === 0){
    AlertMsgAndRedirectTo(ROOT . 'admin/notice/', '작성된 글이 없습니다.');
    exit;
}

?>

<?php require_once ('../inc/head.php');?>

<body class="fix-header fix-sidebar">
<style>
    .editHtmlArea{
        padding: 20px;line-height: normal;font-size: inherit; color: inherit;font-weight: inherit;
    }

    .editHtmlArea p{
        padding: 0;
        margin: 0;
    }
</style>
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
                            <span class="pull-right">
                                <a href="<?php echo ROOT;?>admin/notice/modify.php?id=<?php echo $row[0]['id']; ?>" class="btn btn-danger btn-sm">수정</a>
                                <a href="<?php echo ROOT;?>admin/notice/" class="btn btn-sm btn-primary">목록으로</a>
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <colgroup>
                                        <col width="10%">
                                        <col width="23%">
                                        <col width="10%">
                                        <col width="23%">
                                        <col width="10%">
                                        <col width="24%">
                                    </colgroup>
                                    <tr>
                                        <th>제목</th>
                                        <td colspan="5" align="left" style="text-align: left;"><?php echo replaceQuotationMark($row[0]['title']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>공지일</th>
                                        <td align="left" style="text-align: left;"><?php echo setDate($row[0]['registered_dt']);?></td>
                                        <th>조회수</th>
                                        <td align="left" style="text-align: left;"><?php echo separateCommaNumber($row[0]['count']);?></td>
                                        <th>작성자</th>
                                        <td align="left" style="text-align: left;"><?php echo $row[0]['author'];?></td>
                                    </tr>
                                    <?php if(!empty($row[0]['thumbnail'])){?>
                                        <tr>
                                            <th colspan="6" style="text-align: center;">대표 썸네일</th>
                                        </tr>
                                        <tr>
                                            <td colspan="6" style="text-align: center;padding: 20px 0;">
                                                <img src="<?php echo ROOT;?>assets/uploads/notice/<?php echo $row[0]['thumbnail'];?>"
                                                     alt="<?php echo replaceQuotationMark($row[0]['title']); ?>" style="max-width: 600px;" />
                                            </td>
                                        </tr>
                                    <?php } ?>

                                    <?php if(empty($row[0]['external_link'])){?>
                                        <tr>
                                            <td colspan="6">
                                                <div class="editHtmlArea">
                                                    <?php echo html_entity_decode($row[0]['contents']) ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } else { ?>
                                        <tr>
                                            <td colspan="4" align="left" style="text-align: left;">
                                                <div>연결된 외부링크:</div>
                                                <a href="<?php echo $row[0]['external_link'];?>" target="_blank"><?php echo $row[0]['external_link'];?></a>
                                            </td>
                                            <td colspan="2" align="left" style="text-align: left;">
                                                <div>외부링크 출처:</div>
                                                <?php echo $row[0]['link_origin'];?>
                                            </td>
                                        </tr>
                                    <?php } ?>

                                    <tr>
                                        <td colspan="6">
                                            <span class="pull-right">
                                                <a href="<?php echo ROOT;?>admin/notice/modify.php?id=<?php echo $row[0]['id']; ?>" class="btn btn-danger btn-sm">수정</a>
                                                <a href="<?php echo ROOT;?>admin/notice/" class="btn btn-sm btn-primary">목록으로</a>
                                            </span>
                                        </td>
                                    </tr>
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

<?php require_once ('../inc/foot.php'); ?>
</body>
</html>