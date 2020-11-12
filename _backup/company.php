<?php
require_once('./autoload.php');
require_once('./commons/config.php');
require_once('./commons/utils.php');
require_once('./commons/session.php');

define('PAGE','COMPANY');
define('PAGE_NAME', '회사소개');
define('PAGE_PATH', 'company');

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
            <img src="<?php echo ROOT;?>assets/img/mobile/banner/ban-m-company.jpg" alt="" width="100%" />
        </div>

        <div>
            <img src="<?php echo ROOT;?>assets/img/mobile/img-con-m-company.jpg" alt="" width="100%" />
        </div>

    </div>

    <?php require_once('./inc/vt-footer-m.php');?>
    <?php require_once('./inc/m-fixed-bottom.php');?>

<?php } else { ?>

    <?php require_once('./inc/vt-header-main.php');?>
    <?php require_once('./inc/notice-common-pc.php');?>

    <div class="contents-pc">
        <div class="page-pc-banner-area">
            <img src="<?php echo ROOT;?>assets/img/banner/pc/img-pc-ban-company.jpg" alt="" />
        </div>

        <div class="page-pc-tab-area">
            <?php require_once('./inc/tab-pc-company.php');?>
        </div>

        <div style="background:url('<?php echo ROOT;?>assets/img/pc/img-pc-company.jpg?v=1') no-repeat center 0;height: 2828px;margin-top: 30px;"></div>

    </div>

    <?php require_once('./inc/vt-footer.php');?>
<?php } ?>


<?php require_once('./inc/foot.php');?>

</body>
</html>