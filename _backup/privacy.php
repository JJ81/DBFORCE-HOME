<?php
require_once('./autoload.php');
require_once('./commons/config.php');
require_once('./commons/utils.php');
require_once('./commons/session.php');

define('PAGE','PRIVACY');
define('PAGE_NAME', '개인정보취급방침');
define('PAGE_PATH', 'privacy');

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

    <div id="vt-content-m">
        <div class="page-m-header">
            <h2 class="center">
                <img src="<?php echo ROOT;?>assets/img/mobile/login/img-tit-privacy-m.jpg" alt="" width="160" />
            </h2>
            <h3 class="center">
                <img src="<?php echo ROOT;?>assets/img/mobile/login/img-tit-login-sub.jpg" alt="" width="300" />
            </h3>
        </div>

        <div style="white-space: pre-line;padding: 20px;"><?php echo html_entity_decode($info[0]['privacy']);?></div>
    </div>

    <?php require_once('./inc/vt-footer-m.php');?>

<?php } else { ?>
    <?php require_once('./inc/vt-header-main.php');?>
    <?php require_once('./inc/notice-common-pc.php');?>



    <div class="contents-pc" style="width: 1100px;margin: 0 auto 150px;">
        <div class="page-m-header">
            <h2 class="center">
                <img src="<?php echo ROOT;?>assets/img/mobile/login/img-tit-privacy-m.jpg" alt="" width="160" />
            </h2>
            <h3 class="center">
                <img src="<?php echo ROOT;?>assets/img/mobile/login/img-tit-login-sub.jpg" alt="" width="300" />
            </h3>
        </div>

        <div style="white-space: pre-line;padding: 20px;"><?php echo html_entity_decode($info[0]['privacy']);?></div>
    </div>

    <?php require_once('./inc/vt-footer.php');?>
<?php } ?>



<?php require_once('./inc/foot.php');?>

</body>
</html>