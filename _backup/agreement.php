<?php
require_once('./autoload.php');
require_once('./commons/config.php');
require_once('./commons/utils.php');
define('PAGE','AGREEMENT');

use JCORP\Business\Basics\BasicInfoService as Basic;
$basic=new Basic();

$company_id=1; // 설정시 강제세팅값필요
$info=$basic->getBasicInfoByCompany_id($company_id);



?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <?php require_once('./inc/head.php');?>
    <title><?php echo $info[0]['title'];?>, 개인정보취급방침</title>
</head>

<body>

<?php require_once('./inc/preloader.php');?>

<?php if(isMobile()){ ?>

    <?php require_once('./inc/vt-header-m.php');?>

    <div id="vt-content-m">
        <div style="white-space: pre-line;line-height: 22px;padding: 20px;">
            <!-- <h3>개인정보취급방침 및 마케팅수신동의</h3> -->
            <?php echo html_entity_decode($info[0]['privacy']);?>
        </div>
    </div>

    <?php require_once('./inc/vt-footer-m.php');?>

<?php } else { ?>
    <?php require_once('./inc/vt-header.php');?>

    <div class="vt-contents">
        <div class="vt-contents-inner">
            <div class="vt-content-body">
                <div style="white-space: pre-line;line-height: 22px;">
                    <?php echo html_entity_decode($info[0]['privacy']);?>
                </div>
            </div>
        </div>
    </div>


    <?php require_once('./inc/vt-footer.php');?>
<?php } ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js"></script>
<script src="<?php echo ROOT;?>assets/common.js?v=<?php echo $info[0]['deploy_version'];?>"></script>

</body>
</html>