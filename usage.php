<?php
require_once('./autoload.php');
require_once('./commons/config.php');
require_once('./commons/utils.php');
require_once('./commons/session.php');

define('PAGE','USAGE');
define('PAGE_NAME', '투자약관');
define('PAGE_PATH', 'usage');

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

    <div id="vt-content-m">
        <div class="page-m-header">
            <h2 class="center">
                <img src="<?php echo ROOT;?>assets/img/mobile/login/imt-tit-usage-m.jpg" alt="" width="100" />
            </h2>
            <h3 class="center">
                <img src="<?php echo ROOT;?>assets/img/mobile/login/img-tit-login-sub.jpg" alt="" width="300" />
            </h3>
        </div>

        <div style="white-space: pre-line;padding: 20px;"><?php echo html_entity_decode($info[0]['agreement']);?></div>
    </div>

    <?php require_once ('./inc/vt-footer-m.php');?>

<?php } else { ?>
    <?php require_once ('./inc/vt-header-main.php');?>
    <?php require_once ('./inc/notice-common-pc.php');?>

    <div class="contents-pc">

        <div class="page-pc-banner-area">
            <img src="<?php echo ROOT;?>assets/img/banner/pc/img-pc-ban-notice.jpg" alt="" />
        </div>

        <div class="page-pc-tab-area">
            <?php require_once ('./inc/tab-pc-notice.php');?>
        </div>

        <div class="page-pc-body-area">
            <div class="page-pc-table-head">
                한국경제투자TV <span class="red-emphasis">투자약관</span>
            </div>

            <div class="page-pc-table-body-wrp">
                <div style="white-space: pre-line;padding: 20px;"><?php echo html_entity_decode($info[0]['agreement']);?></div>
            </div>

        </div>
    </div>

    <?php require_once ('./inc/vt-footer.php');?>
<?php } ?>



<?php require_once ('./inc/foot.php');?>

</body>
</html>