<?php
require_once('./autoload.php');
require_once('./commons/config.php');
require_once('./commons/utils.php');
require_once('./commons/session.php');

define('PAGE','STRATEGY');
define('PAGE_NAME', '전략투자본부');
define('PAGE_PATH', 'strategy');

require_once('./inc/common-data.php');

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
        <div class="jp-page-banner-m">
            <img src="<?php echo ROOT;?>assets/img/mobile/banner/ban-m-strategy.jpg" alt="" width="100%" />
        </div>

        <div>
            <img src="<?php echo ROOT;?>assets/img/mobile/img-con-m-strategy.jpg" alt="" width="100%" />
        </div>

    </div>

    <?php require_once('./inc/vt-footer-m.php');?>
    <?php require_once('./inc/m-fixed-bottom.php');?>

<?php } else { ?>

    <?php require_once('./inc/vt-header-main.php');?>
    <?php require_once('./inc/notice-common-pc.php');?>

    <div class="contents-pc">
        <div class="page-pc-banner-area">
            <img src="<?php echo ROOT;?>assets/img/banner/pc/img-ban-pc-strategy.jpg" alt="" />
        </div>

        <div class="page-pc-tab-area">
            <?php require_once('./inc/tab-pc-company.php');?>
        </div>

        <div style="margin-top: 30px;background: url('<?php echo ROOT;?>assets/img/pc/img-pc-strategy.jpg') no-repeat center 0;height: 940px;"></div>

    </div>

    <?php require_once('./inc/vt-footer.php');?>
<?php } ?>


<?php require_once('./inc/foot.php');?>

</body>
</html>