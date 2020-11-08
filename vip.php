<?php
require_once('./autoload.php');
require_once('./commons/config.php');
require_once('./commons/utils.php');
require_once('./commons/session.php');

define('PAGE','VIP');
define('PAGE_NAME', ' VIP 서비스');
define('PAGE_PATH', 'vip');

require_once ('./inc/common-data.php');

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <?php require_once('./inc/head.php') ;?>
    <title><?php echo $info[0]['title'];?>, <?php echo PAGE_NAME;?></title>
</head>

<body>

<?php require_once('./inc/preloader.php') ;?>

<?php if(isMobile()){ ?>

    <?php require_once ('./inc/vt-header-m.php');?>

    <div id="jp-content-m">
<!--        <div style="padding: 200px 0;text-align: center;">-->
<!--            준비중입니다.-->
<!--        </div>-->
        <img src="<?php echo ROOT;?>assets/img/vip/vip-pc-info.jpg" alt="" width="100%" />
        <div>
            <a href="<?php echo EVENT_PAGE_URL;?>" target="_blank">
                <img src="<?php echo ROOT;?>assets/img/vip/btn-req-vip.jpg" alt="" width="100%" />
            </a>
        </div>
    </div>

    <?php require_once ('./inc/vt-footer-m.php');?>
    <?php require_once ('./inc/m-fixed-bottom.php');?>

<?php } else { ?>

    <?php require_once ('./inc/vt-header-main.php');?>
    <?php require_once ('./inc/notice-common-pc.php');?>

    <div class="contents-pc">
        <div style="margin: 0 auto;width: 1200px;margin-top: 10px;">
            <img src="<?php echo ROOT;?>assets/img/vip/vip-pc-info.jpg" alt="" width="1200" />
            <div>
                <a href="<?php echo EVENT_PAGE_URL;?>" target="_blank">
                    <img src="<?php echo ROOT;?>assets/img/vip/btn-req-vip.jpg" alt="" />
                </a>
            </div>
        </div>

    </div>

    <?php require_once ('./inc/vt-footer.php');?>
<?php } ?>


<?php require_once ('./inc/foot.php');?>

</body>
</html>