<?php
require_once('./autoload.php');
require_once('./commons/config.php');
require_once('./commons/utils.php');
define('PAGE','NEWS');

use JCORP\Business\Basics\BasicInfoService as Basic;
$basic=new Basic();

$id=getDataByGet('id');

if(empty($id)){
    AlertMsgAndRedirectTo(ROOT . 'admin/news.php', '잘못된 접근입니다.');
    exit;
}

$company_id=1; // 설정시 강제세팅값필요
$privacy=$basic->getPrivacyInfo($company_id);
$info=$basic->getBasicInfoByCompany_id($company_id);

use \JCORP\Business\News\NewsService as News;
$news=new News();

$news->increaseCount($id);
$news_info=$news->getListById($id);

if($news_info[0]['is_delete'] == '1' or count($news_info) === 0){
    AlertMsgAndRedirectTo(ROOT . 'admin/news.php', '존재하지 않는 글입니다.');
    exit;
}

$prevAndNext=$news->getBoardPrevAndNext($id);
error_log(print_r($prevAndNext, true));

$prev_id=count($prevAndNext['prev']) > 0 ? $prevAndNext['prev'][0]['id'] : null;
$next_id=count($prevAndNext['next']) > 0 ? $prevAndNext['next'][0]['id'] : null;

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <?php require_once('./inc/head.php') ;?>
    <title><?php echo $info[0]['title'];?>, 금융뉴스</title>
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
        <strong>안심금융조회서비스 &nbsp;>&nbsp; 금융뉴스</strong>
    </div>
</div>

<div class="as-page-header2">
    <div class="as-page-header-inner2" style="border-color: #fff;">
        금융뉴스
        <div class="as-page-header-desc">안심금융조회서비스가 전달하는 금융 정보<br />금융활동에 도움이 되는 핵심 정보를 모았습니다!</div>
    </div>
</div>

<div class="as-item-details">
    <div class="as-item-details-inner">

        <table class="as-notice-table-details">
            <thead>
            <tr>
                <th>
                    <?php echo $news_info[0]['title'] ;?>
                    <?php
                    $registered_dt=new DateTime($news_info[0]['registered_dt']);
                    $today=new DateTime(getToday('Y-m-d H:i:s'));
                    if(date_diff($registered_dt, $today)->days < 7){?>
                        <span class="as-ico-new">NEW</span>
                    <?php } ?>
                </th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td class="text-align-right">
                    <?php echo $news_info[0]['author'] ;?>&nbsp;
                    <span class="text-splitter">|</span>&nbsp;
                    <?php echo setDate($news_info[0]['registered_dt']) ;?>&nbsp;
                    <span class="text-splitter">|</span>&nbsp;
                    조회수 <?php echo separateCommaNumber($news_info[0]['count']);?>
                </td>
            </tr>
            <?php if(!empty($news_info[0]['thumbnail'])) { ?>
                <tr>
                    <td class="center" style="padding: 50px 0;">
                        <img src="<?php ROOT;?>assets/uploads/news/<?php echo $news_info[0]['thumbnail'];?>"
                             alt="<?php echo $news_info[0]['title'] ;?>" style="max-width: 600px;" />
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td>
                    <div class="as-notice-details-area"><?php echo html_entity_decode($news_info[0]['contents']) ?></div>
                </td>
            </tr>
            </tbody>

            <tfoot>
            <tr>
                <td class="as-notice-move-area">
                    <?php if(!empty($prev_id)) {?>
                        <a href="<?php echo ROOT;?>news_view.php?id=<?php echo $prev_id;?>" class="as-notice-prev"> < 이전글 </a>
                    <?php } ?>
                    <?php if(!empty($next_id)) {?>
                        <a href="<?php echo ROOT;?>news_view.php?id=<?php echo $next_id;?>" class="as-notice-next"> 다음글 > </a>
                    <?php } ?>
                </td>
            </tr>
            </tfoot>
        </table>

        <div class="as-notice-bottom-btn-area">
            <a href="<?php echo ROOT;?>news.php">목록으로</a>
        </div>

    </div>
</div>

<?php require_once ('./inc/as-footer.php');?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js"></script>
<script src="<?php echo ROOT;?>assets/common.js?v=<?php echo $info[0]['deploy_version'];?>"></script>
<script>


</script>
</body>
</html>