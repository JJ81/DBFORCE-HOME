<?php
require_once('./autoload.php');
require_once('./commons/config.php');
require_once('./commons/utils.php');
require_once('./commons/session.php');

define('PAGE','MAIN');
define('PAGE_NAME', '메인페이지');
define('PAGE_PATH', 'main');

require_once('./inc/common-data.php');




?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <?php require_once('./inc/head.php');?>
    <title><?php echo $info[0]['title'];?></title>
</head>

<body>

    <?php require_once('./inc/preloader.php');?>

    <?php if(isMobile()){ ?>

        <?php require_once('./inc/vt-header-m.php');?>

        <div id="jp-content-m">
            contents Mobile
        </div>

        <?php require_once('./inc/vt-footer-m.php');?>
        <?php require_once('./inc/m-fixed-bottom.php');?>

    <?php } else { ?>
        <?php require_once('./inc/vt-header-main.php');?>
        <?php require_once('./inc/notice-common-pc.php');?>



        <div class="contents-pc">
            contents PC
        </div>

        <?php require_once('./inc/vt-footer.php');?>
    <?php } ?>

    <?php require_once('./inc/foot.php');?>
    <?php if(isMobile()){ ?>
        <script src="<?php echo ROOT;?>assets/js/main.m.js?v=<?php echo $info[0]['deploy_version'];?>"></script>
    <?php } else { ?>
        <script src="<?php echo ROOT;?>assets/js/main.pc.js?v=<?php echo $info[0]['deploy_version'];?>"></script>
    <?php } ?>
</body>
</html>