<?php
require_once('./autoload.php');
require_once('./commons/config.php');
require_once('./commons/utils.php');
define('PAGE','REVIEW');

use JCORP\Business\Basics\BasicInfoService as Basic;
$basic=new Basic();

$id=getDataByGet('id');
if(empty($id)){
    AlertMsgAndRedirectTo(ROOT . 'review.php', '잘못된 접근입니다.');
    exit;
}

$company_id=1; // 설정시 강제세팅값필요
$privacy=$basic->getPrivacyInfo($company_id);
$info=$basic->getBasicInfoByCompany_id($company_id);

use \JCORP\Business\News\NewsService as News;
$news=new News();

$news->increaseCount($id);
$notice_info=$news->getListById($id);

if($notice_info[0]['is_delete'] == '1' or count($notice_info) === 0){
    AlertMsgAndRedirectTo(ROOT . 'review.php', '존재하지 않는 글입니다.');
    exit;
}


$prevAndNext=$news->getBoardPrevAndNext($id);
error_log(print_r($prevAndNext, true));

$prev_id=count($prevAndNext['prev']) > 0 ? $prevAndNext['prev'][0]['id'] : null;
$next_id=count($prevAndNext['next']) > 0 ? $prevAndNext['next'][0]['id'] : null;


?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <?php require_once('./inc/head.php') ;?>
    <title><?php echo $info[0]['title'];?>, 이용후기</title>
</head>

<body>

<?php require_once('./inc/preloader.php') ;?>

<?php if(isMobile()){ ?>

    <?php require_once ('./inc/vt-header-m.php');?>

    <div id="vt-content-m">
        <div>
            <img src="<?php echo ROOT;?>assets/img/mobile/banner/img-m-ban-review.jpg" alt="" width="100%" />
        </div>

        <div style="padding-top: 50px;">
            <img src="<?php echo ROOT;?>assets/img/mobile/img-m-review-title.jpg" alt="" width="100%" />
        </div>

        <div style="padding: 15px;">
            <table class="vt-group-info-table">
                <thead>
                <tr>
                    <th style="text-align: left;font-size: 16px;line-height: 22px;">
                        <?php echo replaceQuotationMark($notice_info[0]['title']) ;?>
                        <?php
                        $registered_dt=new DateTime($notice_info[0]['registered_dt']);
                        $today=new DateTime(getToday('Y-m-d H:i:s'));
                        if(date_diff($registered_dt, $today)->days < 7){?>
                            <span class="vt-ico-new">NEW</span>
                        <?php } ?>
                    </th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td class="vt-group-info-sub">
                        <?php echo $notice_info[0]['author'] ;?>&nbsp;
                        <span class="text-splitter">|</span>&nbsp;
                        <?php echo setDate($notice_info[0]['registered_dt']) ;?>&nbsp;
                        <span class="text-splitter">|</span>&nbsp;
                        조회수 <?php echo separateCommaNumber($notice_info[0]['count']);?>
                    </td>
                </tr>
                <?php if(!empty($notice_info[0]['thumbnail'])) { ?>
                    <tr>
                        <td class="center" style="padding: 20px 0;">
                            <img src="<?php ROOT;?>assets/uploads/news/<?php echo $notice_info[0]['thumbnail'];?>"
                                 alt="<?php echo $notice_info[0]['title'] ;?>" style="width:100%; max-width: 600px;" />
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td>
                        <div class="as-notice-details-area"><?php echo html_entity_decode($notice_info[0]['contents']) ?></div>
                    </td>
                </tr>
                </tbody>

                <?php if(!empty($prev_id) or !empty($next_id)){ ?>
                    <tfoot>
                    <tr>
                        <td class="as-notice-move-area">
                            <?php if(!empty($prev_id)) {?>
                                <a href="<?php echo ROOT;?>review_view.php?id=<?php echo $prev_id;?>" class="as-notice-prev"> < 이전글 </a>
                            <?php } ?>
                            <?php if(!empty($next_id)) {?>
                                <a href="<?php echo ROOT;?>review_view.php?id=<?php echo $next_id;?>" class="as-notice-next"> 다음글 > </a>
                            <?php } ?>
                        </td>
                    </tr>
                    </tfoot>
                <?php } ?>
            </table>
        </div>


        <div class="as-notice-bottom-btn-area">
            <a href="<?php echo ROOT;?>review.php">목록으로</a>
        </div>

    </div>

    <?php require_once ('./inc/vt-footer-m.php');?>
    <?php require_once ('./inc/m-fixed-bottom.php');?>
<?php } else { ?>
    <?php require_once ('./inc/vt-header.php');?>

    <div class="vt-contents">
        <div class="vt-contents-inner">
            <div class="vt-content-header">
                <div class="vt-content-header-title">
                    <img src="./assets/img/img-title-review.jpg" alt="이용후기" width="140" />
                </div>
                <div class="vt-content-header-desc">
                    타임인베스트먼트와 함께 하시는 고객님의 솔직한 후기를 공개합니다.
                </div>
            </div>

            <div class="vt-content-body" style="padding-bottom: 100px;">
                <table class="as-notice-table-details">
                    <thead>
                    <tr>
                        <th>
                            <?php echo replaceQuotationMark($notice_info[0]['title']) ;?>
                            <?php
                            $registered_dt=new DateTime($notice_info[0]['registered_dt']);
                            $today=new DateTime(getToday('Y-m-d H:i:s'));
                            if(date_diff($registered_dt, $today)->days < 7){?>
                                <span class="as-ico-new">NEW</span>
                            <?php } ?>
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td class="text-align-right">
                            <?php echo $notice_info[0]['author'] ;?>&nbsp;
                            <span class="text-splitter">|</span>&nbsp;
                            <?php echo setDate($notice_info[0]['registered_dt']) ;?>&nbsp;
                            <span class="text-splitter">|</span>&nbsp;
                            조회수 <?php echo separateCommaNumber($notice_info[0]['count']);?>
                        </td>
                    </tr>
                    <?php if(!empty($notice_info[0]['thumbnail'])) { ?>
                        <tr>
                            <td class="center" style="padding: 50px 0;">
                                <img src="<?php ROOT;?>assets/uploads/news/<?php echo $notice_info[0]['thumbnail'];?>"
                                     alt="<?php echo $notice_info[0]['title'] ;?>" style="max-width: 600px;" />
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td>
                            <div class="as-notice-details-area"><?php echo html_entity_decode($notice_info[0]['contents']) ?></div>
                        </td>
                    </tr>
                    </tbody>

                    <?php if(!empty($prev_id) or !empty($next_id)){ ?>
                    <tfoot>
                    <tr>
                        <td class="as-notice-move-area">
                            <?php if(!empty($prev_id)) {?>
                                <a href="<?php echo ROOT;?>review_view.php?id=<?php echo $prev_id;?>" class="as-notice-prev"> < 이전글 </a>
                            <?php } ?>
                            <?php if(!empty($next_id)) {?>
                                <a href="<?php echo ROOT;?>review_view.php?id=<?php echo $next_id;?>" class="as-notice-next"> 다음글 > </a>
                            <?php } ?>
                        </td>
                    </tr>
                    </tfoot>
                    <?php } ?>
                </table>

                <div class="as-notice-bottom-btn-area">
                    <a href="<?php echo ROOT;?>review.php" style="background: #c1272d;">목록으로</a>
                </div>
            </div>
        </div>
    </div>

    <?php require_once ('./inc/vt-footer.php');?>

<?php } ?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js"></script>
<script src="<?php echo ROOT;?>assets/common.js?v=<?php echo $info[0]['deploy_version'];?>"></script>

</body>
</html>