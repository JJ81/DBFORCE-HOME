<?php
require_once('./autoload.php');
require_once('./commons/config.php');
require_once('./commons/utils.php');
define('PAGE','SERVICE');

use JCORP\Business\Basics\BasicInfoService as Basic;
$basic=new Basic();

$company_id=1; // 설정시 강제세팅값필요
$info=$basic->getBasicInfoByCompany_id($company_id);



?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <?php require_once('./inc/head.php') ;?>
    <title><?php echo $info[0]['title'];?></title>
</head>

<body>

<?php require_once('./inc/preloader.php') ;?>

<?php if(isMobile()){ ?>
    <!--        Mobile-->
<?php } else { ?>
    <!--        PC-->
<?php } ?>

<?php require_once ('./inc/vt-header.php');?>

<div class="vt-contents">
    <div class="vt-contents-inner">
        <div class="vt-content-header">
            <div class="center">
                <img src="<?php echo ROOT;?>assets/img/img-logo-symbol.png" alt="승리투자그룹" />
            </div>
            <div class="vt-content-header-title">
                서비스 안내
            </div>
            <div class="vt-content-header-desc">
                고객이 승리하는 주식투자
            </div>
        </div>
    </div>

    <div class="vt-service-info-top">
        <div class="vt-service-info-top-inner">
            승리 투자그룹은 확고한 투자철학과 운영이념으로 고객분들이게 실질적인 도움이 되는 투자 서비스를<br />
            제공하기 위해  노력하고 있습니다. 고객이 신뢰할 수 있는 서비스가 되도록 기초에 충실한 분석과<br />
            전문가의 경험을 기반으로 한 연구, 투명한 운영을 원칙으로 고객이 승리하는 날까지 최선을 다하겠습니다.
        </div>
    </div>

    <div class="center" style="padding: 50px 0;">
        <img src="<?php echo ROOT;?>assets/img/img-invest-strategy.jpg" alt="투자전략" />
    </div>

    <div class="center" style="background: #0d0d2a;">
        <img src="<?php echo ROOT;?>assets/img/img-service-vip-info.jpg" alt="VIP서비스" />
    </div>

    <div>
        <div style="text-align: center;background: url('<?php echo ROOT;?>assets/img/banner/img-expert-bottom.jpeg') no-repeat center 0">
            <img src="<?php echo ROOT;?>assets/img/banner/img-expert-bottom.jpeg" alt="" style="visibility: hidden;" />
        </div>
    </div>
</div>


<?php require_once ('./inc/vt-footer.php');?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js"></script>
<script src="<?php echo ROOT;?>assets/common.js?v=<?php echo $info[0]['deploy_version'];?>"></script>

</body>
</html>