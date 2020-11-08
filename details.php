<?php
require_once('./autoload.php');
require_once('./commons/config.php');
require_once('./commons/utils.php');
define('PAGE','DETAILS');

use JCORP\Business\Basics\BasicInfoService as Basic;
$basic=new Basic();

$company_id=1; // 설정시 강제세팅값필요
$privacy=$basic->getPrivacyInfo($company_id);
$info=$basic->getBasicInfoByCompany_id($company_id);

$type=getDataByGet('type');
// type
// 대출 LN, 보험 IS, 적금 RD, 예금 D2

if(empty($type)){
    Redirect(ROOT . 'details.php?type=LN');
    exit;
}

use \JCORP\Business\FinLifeApi\InstallmentDepositService as Install;
$install=new Install();

use \JCORP\Business\FinLifeApi\RegularDepositService as Regular;
$regular=new Regular();

$company_id=1;

// 출력할 정보 목록
$rows=[];

if($type === 'LN'){

}else if($type === 'IS'){

} else if($type === 'RD'){
    // 적금 정보 출력
    $rows=$install->getInstallList($company_id);
} else if($type === 'D2'){
    // 예금 정보 출력
    $rows=$regular->getDepositList($company_id);
} else{
    AlertMsgAndRedirectTo(ROOT, '잘못된 접근입니다.');
    exit;
}


?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <?php require_once('./inc/head.php') ;?>
    <title><?php echo $info[0]['title'];?>, 상품 소개</title>
</head>

<body>

    <?php require_once('./inc/preloader.php') ;?>

    <?php if(isMobile()){ ?>
<!--        Mobile-->
    <?php } else { ?>
<!--        PC-->
    <?php } ?>

    <?php require_once ('./inc/as-header.php');?>


    <div class="as-breadcrumb">
        <div class="as-breadcrumb-inner">
            <img src="<?php echo ROOT;?>assets/img/ico-logo-white.jpg" alt="" />&nbsp;
            <strong>안심금융조회서비스 &nbsp;>&nbsp; 적금</strong>
        </div>
    </div>

    <div class="as-page-header2">
        <div class="as-page-header-inner2" style="border: none;">
            <?php if($type === 'LN'){ ?>
                대출 소개
                <div class="as-page-header-desc">안심금융조회서비스 전문가의 추천 대출<br />한 눈에 비교 분석해 보세요!</div>
            <?php }else if($type === 'IS'){ ?>
                보험 소개
                <div class="as-page-header-desc">안심금융조회서비스 전문가의 추천 보험<br />한 눈에 비교 분석해 보세요!</div>
            <?php } else if($type === 'RD'){ ?>
                적금 소개
                <div class="as-page-header-desc">안심금융조회서비스 전문가의 추천 적금<br />한 눈에 비교 분석해 보세요!</div>
            <?php } else if($type === 'D2'){ ?>
                예금 소개
                <div class="as-page-header-desc">안심금융조회서비스 전문가의 추천 예금<br />한 눈에 비교 분석해 보세요!</div>
            <?php } ?>
        </div>
    </div>

    <?php if($type === 'LN'){ ?>
    <div class="as-tab-loan">
        <ul class="as-tab-loan-body clearfix">
            <li class="as-tab-loan-list">
                <a href="#" class="as-tab-loan-link as-tab-loan-link-active">주택담보대출</a>
            </li>
            <li class="as-tab-loan-list">
                <a href="#" class="as-tab-loan-link">전세자금대출</a>
            </li>
            <li class="as-tab-loan-list">
                <a href="#" class="as-tab-loan-link">개인신용대출</a>
            </li>
        </ul>
    </div>

    <div class="as-loan-breadcrumb">
        대출 > 주택담보대출
    </div>
    <?php } ?>

    <div class="as-item-details">
        <div class="as-item-details-inner">
            <!-- TODO 상품에 따라서 보이는 항목이 달라질 수 있다. -->

            <table class="as-item-details-table" <?php if($type === 'LN'){ echo 'style="margin-top: 0;"';}?>>
                <colgroup>
                    <col width="*">
                    <col width="*">
                    <col width="130">
                    <col width="130">
                    <col width="263">
                </colgroup>
                <thead>
                <tr>
                    <th>금융사</th>
                    <th>상품명</th>
                    <th>세전금리</th>
                    <th>우대금리</th>
                    <th>상담신청</th>
                </tr>
                </thead>
                <tbody>
                <?php for($r=0,$size=count($rows);$r<$size;$r++){?>
                <tr>
                    <td>
                        <img src="<?php echo ROOT;?>assets/img/company/<?php echo $rows[$r]['fin_co_no'] ;?>.png"
                             alt="<?php echo $rows[$r]['kor_co_nm'] ;?>"
                             class="as-financial-group-logo" />
                    </td>
                    <td>
                        <?php echo $rows[$r]['fin_prdt_nm'] ;?>
                    </td>
                    <td> ?% </td>
                    <td> ?% </td>
                    <td>
                        <a href="#" class="as-item-details-link-details">
                            <img src="<?php echo ROOT;?>assets/img/ico-details.png" alt="" />
                            상세보기
                        </a>
                        <a href="#" class="as-item-details-link-request">상담신청</a>
                    </td>
                </tr>
                <?php } ?>


                </tbody>
            </table>
        </div>
    </div>

    <?php require_once ('./inc/as-footer.php');?>
    <?php require_once ('./inc/modal_request.php');?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js"></script>
    <script src="<?php echo ROOT;?>assets/common.js?v=<?php echo $info[0]['deploy_version'];?>"></script>
    <script>


    </script>
</body>
</html>