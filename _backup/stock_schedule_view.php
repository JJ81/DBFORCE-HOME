<?php
require_once('./autoload.php');
require_once('./commons/config.php');
require_once('./commons/utils.php');
require_once('./commons/session.php');

define('PAGE','STOCK_SCHEDULE');
define('PAGE_NAME', '증시일정');
define('PAGE_PATH', 'stock_schedule_view');
define('PAGE_ORIGIN', 'stock_schedule');


require_once('./inc/common-data.php');

$id=getDataByGet('id');

if(empty($id)){
    Redirect(ROOT .  'notice.php?page=1');
    exit;
}

use JCORP\Business\StockScheduleService\StockScheduleService as StockSchedule;
$inc=new StockSchedule();

$inc_info=$inc->getListById($id);

if(count($inc_info) == 0){
    Redirect(ROOT .  PAGE_ORIGIN . '.php?page=1');
    exit;
}

$prevAndNext=$inc->getBoardPrevAndNext($id);
error_log(print_r($prevAndNext, true));

$prev_id=count($prevAndNext['prev']) > 0 ? $prevAndNext['prev'][0]['id'] : null;
$next_id=count($prevAndNext['next']) > 0 ? $prevAndNext['next'][0]['id'] : null;

// 조회수 카운트
$inc->increaseCount($id);

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <?php require_once('./inc/head.php');?>
    <title><?php echo $info[0]['title'];?>, <?php echo PAGE_NAME;?></title>
</head>

<body>

<?php require_once('./inc/preloader.php');?>

<?php if(isMobile()){ ?>

    <?php require_once('./inc/vt-header-m.php');?>

    <div id="jp-content-m">

        <div class="jp-page-view-m">
            <?php echo PAGE_NAME;?>
        </div>

        <div class="jp-board-info-wrp">
            <div class="jp-board-info-head">
                <div class="jp-board-info-title">
                    <?php echo replaceQuotationMark($inc_info[0]['title']);?>
                </div>
                <div class="jp-board-info-title-sub">
<!--                    --><?php //echo $inc_info[0]['author'];?>
<!--                    <span class="splitter">|</span>-->
                    작성일:
                    <?php echo setDate($inc_info[0]['registered_dt']);?>
                    <span class="splitter">|</span>
                    조회수:
                    <?php echo separateCommaNumber($inc_info[0]['count']);?>
                </div>
            </div>

            <div class="jp-board-info-body">
                <div class="editHtmlArea"><?php echo html_entity_decode($inc_info[0]['contents']) ?></div>
            </div>

            <div class="jp-board-info-foot clearfix">
                <a href="./<?php echo PAGE_ORIGIN;?>.php" class="btn-m-list">
                    <img src="<?php echo ROOT;?>assets/img/mobile/btn-m-list.jpg" alt="" width="60" />
                </a>
                <a href="javascript:window.history.back(-1);" class="btn-m-back">
                    <img src="<?php echo ROOT;?>assets/img/mobile/btn-m-back.jpg" alt="" width="60" />
                </a>
                <!--                --><?php //if(!empty($prev_id) or !empty($next_id)){ ?>
                <!--                    --><?php //if(!empty($prev_id)) {?>
                <!--                        <a href="--><?php //echo ROOT;?><!--profit_view.php?id=--><?php //echo $prev_id;?><!--" class="as-notice-prev"> < 이전글 </a>-->
                <!--                    --><?php //} ?>
                <!--                    --><?php //if(!empty($next_id)) {?>
                <!--                        <a href="--><?php //echo ROOT;?><!--profit_view.php?id=--><?php //echo $next_id;?><!--" class="as-notice-next"> 다음글 > </a>-->
                <!--                    --><?php //} ?>
                <!--                --><?php //} ?>
            </div>
        </div>

    </div>

    <?php require_once('./inc/vt-footer-m.php');?>
    <?php require_once('./inc/m-fixed-bottom.php');?>

<?php } else { ?>
    <?php require_once('./inc/vt-header-main.php');?>
    <?php require_once('./inc/notice-common-pc.php');?>

    <div class="contents-pc">

        <div class="page-pc-banner-area">
            <img src="<?php echo ROOT;?>assets/img/banner/pc/img-pc-ban-stock-schedule.jpg" alt="" />
        </div>

        <div class="page-pc-body-area">

            <div class="jp-board-info-head">
                <div class="jp-board-info-title">
                    <?php echo replaceQuotationMark($inc_info[0]['title']);?>
                </div>
                <div class="jp-board-info-title-sub">
                    <!--                    --><?php //echo $inc_info[0]['author'];?>
                    <!--                    <span class="splitter">|</span>-->
                    작성일:
                    <?php echo setDate($inc_info[0]['registered_dt']);?>
                    <span class="splitter">|</span>
                    조회수:
                    <?php echo separateCommaNumber($inc_info[0]['count']);?>
                </div>
            </div>

            <div class="jp-board-info-body">
                <div class="editHtmlArea"><?php echo html_entity_decode($inc_info[0]['contents']) ?></div>
            </div>

            <div class="jp-board-info-foot clearfix">
                <a href="./<?php echo PAGE_ORIGIN;?>.php" class="btn-m-list">
                    <img src="<?php echo ROOT;?>assets/img/mobile/btn-m-list.jpg" alt="" width="60" />
                </a>
                <a href="javascript:window.history.back(-1);" class="btn-m-back">
                    <img src="<?php echo ROOT;?>assets/img/mobile/btn-m-back.jpg" alt="" width="60" />
                </a>
                <!--                --><?php //if(!empty($prev_id) or !empty($next_id)){ ?>
                <!--                    --><?php //if(!empty($prev_id)) {?>
                <!--                        <a href="--><?php //echo ROOT;?><!--profit_view.php?id=--><?php //echo $prev_id;?><!--" class="as-notice-prev"> < 이전글 </a>-->
                <!--                    --><?php //} ?>
                <!--                    --><?php //if(!empty($next_id)) {?>
                <!--                        <a href="--><?php //echo ROOT;?><!--profit_view.php?id=--><?php //echo $next_id;?><!--" class="as-notice-next"> 다음글 > </a>-->
                <!--                    --><?php //} ?>
                <!--                --><?php //} ?>
            </div>


        </div>
    </div>

    <?php require_once('./inc/vt-footer.php');?>
<?php } ?>

<?php require_once('./inc/foot.php');?>

</body>
</html>