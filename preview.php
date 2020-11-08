<?php
require_once('./autoload.php');
require_once('./commons/config.php');
require_once('./commons/utils.php');
require_once('./commons/session.php');
define('PAGE','MAIN');

use JCORP\Business\Basics\BasicInfoService as Basic;
$basic=new Basic();

if(empty($_SESSION['user'])){
    AlertMsgAndRedirectTo(ROOT , '접근 권한이 없습니다.');
    exit;
}

$company_id=1; // 설정시 강제세팅값필요
$privacy=$basic->getPrivacyInfo($company_id);
$info=$basic->getBasicInfoByCompany_id($company_id);

use \JCORP\Business\Template\TemplateService as Template;
$template=new Template();

use \JCORP\Business\Campaign\CampaignService as Campaign;
$campaign=new Campaign();
$id=intval(getDataByGet('id'));

if(empty($id)){
    echo "잘못된 접근입니다.";
    exit;
}

$templateId=$campaign->getCampaignById($company_id, $id);
error_log(print_r($templateId, true));

$template_info=$template->getTemplateByItsId($templateId[0]['template_id']);

error_log(print_r($template_info, true));

// TODO redirect 정보가 있을 경우 redirect 될 수 있도록 한다.


// TODO 게시판형 (게시판이 필요한 경우 출력할 정보를 미리 쿼리하여 가져와야 한다.)

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <?php require_once('./inc/head.php') ;?>
    <title><?php echo $info[0]['title'];?></title>
</head>

<body>

    <?php require_once('./inc/preloader.php') ;?>
    <?php // TODO 순서대로 출력하되 각 템플릿의 타입에 맞게 출력할 수 있도록 한다. ?>
    <?php for($i=0,$size=count($template_info);$i<$size;$i++){  ?>
        <?php if($template_info[$i]['template_type'] === 'IM') {?>
            <!-- 이미지형 일 경우 -->
            <div style="max-width: 1000px;margin: 0 auto;">
                <img src="<?php echo ROOT;?>assets/uploads/images/<?php echo $template_info[$i]['image'];?>"
                     alt=""
                     width="100%" />
            </div>
        <?php } else if($template_info[$i]['template_type'] === 'BD') { ?>
        <!-- 게시판형 일 경우 -->
        게시판형 (게시판이 필요한 경우 출력할 정보를 미리 쿼리하여 가져와야 한다.)
        <?php } else if($template_info[$i]['template_type'] === 'HT') { ?>
        <!-- HTML형 일 경우 -->
        HTML형
        <?php } ?>
    <?php } ?>
    
    <hr />

    <?php require_once "./inc/modal_privacy.php" ;?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easy-ticker/2.0.0/jquery.easy-ticker.min.js"></script>
    <script src="<?php echo ROOT;?>assets/common.js?v=<?php echo $info[0]['deploy_version'];?>"></script>
    <script src="https://www.youtube.com/iframe_api"></script>
    <script src="<?php echo ROOT;?>assets/common.js?v=<?php echo $info[0]['deploy_version'];?>"></script>
    <script src="<?php echo ROOT;?>assets/video.js?v=<?php echo $info[0]['deploy_version'];?>"></script>
    <script src="<?php echo ROOT;?>assets/form_request.js?v=<?php echo $info[0]['deploy_version'];?>"></script>
</body>
</html>