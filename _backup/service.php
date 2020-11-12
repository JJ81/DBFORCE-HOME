<?php
require_once('./autoload.php');
require_once('./commons/config.php');
require_once('./commons/utils.php');
define('PAGE','SERVICE');

use JCORP\Business\Basics\BasicInfoService as Basic;
$basic=new Basic();

$company_id=1; // 설정시 강제세팅값필요
$info=$basic->getBasicInfoByCompany_id($company_id);

use \JCORP\Business\Notice\NoticeService as Notice;
$notice=new Notice();

// 고객센터 최신 5개의 글 가져오기
$notice_list=$notice->getList(0, 1);

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

    <div id="vt-content-m">

        <div>
            <img src="<?php echo ROOT;?>assets/img/mobile/banner/img-m-ban-service.jpg" alt="" width="100%" />
        </div>

        <?php require_once('./inc/notice-m.php');?>

        <div>
            <img src="<?php echo ROOT;?>assets/img/mobile/img-m-service-info.jpg" alt="" width="100%" />
        </div>

        <?php require_once('./inc/m-btm-common.php');?>
    </div>

    <?php require_once('./inc/vt-footer-m.php');?>
    <?php require_once('./inc/m-fixed-bottom.php');?>

<?php } else { ?>
    <?php require_once('./inc/vt-header.php');?>
    <?php require_once('./inc/notice-pc.php');?>

    <div class="vt-contents">
        <div style="background: url('./assets/img/img-service-info-pc.jpg') no-repeat center top; height: 1962px;"></div>
    </div>


    <?php require_once('./inc/vt-footer.php');?>
<?php } ?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js"></script>
<script src="<?php echo ROOT;?>assets/js/vendors/jquery.tickerNews.min.js"></script>
<script src="<?php echo ROOT;?>assets/common.js?v=<?php echo $info[0]['deploy_version'];?>"></script>

</body>
</html>