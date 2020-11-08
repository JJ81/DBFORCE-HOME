<?php
require_once('./autoload.php');
require_once('./commons/config.php');
require_once('./commons/utils.php');
define('PAGE','USAGE');

use JCORP\Business\Basics\BasicInfoService as Basic;
$basic=new Basic();

$company_id=1; // 설정시 강제세팅값필요
$info=$basic->getBasicInfoByCompany_id($company_id);



?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <?php require_once('./inc/head.php') ;?>
    <title><?php echo $info[0]['title'];?>, 마케팅이용방침</title>
</head>

<body>

<?php require_once('./inc/preloader.php') ;?>

<?php if(isMobile()){ ?>

    <?php require_once ('./inc/vt-header-m.php');?>

    <div id="vt-content-m">
        <div class="page-m-header">
            <h2 class="center">
                <img src="<?php echo ROOT;?>assets/img/mobile/login/img-tit-marketing-m.jpg" alt="" width="140" />
            </h2>
            <h3 class="center">
                <img src="<?php echo ROOT;?>assets/img/mobile/login/img-tit-login-sub.jpg" alt="" width="300" />
            </h3>
        </div>

        <div style="white-space: pre-line;padding: 20px;"><?php echo html_entity_decode($info[0]['marketing']);?></div>
    </div>

    <?php require_once ('./inc/vt-footer-m.php');?>

<?php } else { ?>
    <div>준비중입니다.</div>
<?php } ?>



<?php require_once ('./inc/foot.php');?>

</body>
</html>