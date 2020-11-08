<?php
require_once('./autoload.php');
require_once('./commons/config.php');
require_once('./commons/utils.php');
define('PAGE','NEWS');

use JCORP\Business\Basics\BasicInfoService as Basic;
$basic=new Basic();

$company_id=1; // 설정시 강제세팅값필요
$privacy=$basic->getPrivacyInfo($company_id);
$info=$basic->getBasicInfoByCompany_id($company_id);

// 페이징 처리와 금융뉴스
use \JCORP\Business\News\NewsService as News;
$news=new News();

$news_list=$news->getList(0, 1000);


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
        <ul class="as-news-table">
            <?php for($i=0,$size=count($news_list);$i<$size;$i++){?>
                <li class="as-news-table-list">
                    <?php if(empty($news_list[$i]['external_link'])){?>
                        <a href="<?php echo ROOT;?>news_view.php?id=<?php echo $news_list[$i]['id']; ?>" class="as-news-table-link">
                            <?php echo $news_list[$i]['title'];?>
                        </a>
                        <span class="as-news-table-list-date">
                            <?php echo setDate($news_list[$i]['registered_dt']); ?>
                            <?php echo $news_list[$i]['author'] ?>
                        </span>
                    <?php }else{ ?>
                        <a href="<?php echo $news_list[$i]['external_link']; ?>" target="_blank" class="as-news-table-link">
                            <?php echo $news_list[$i]['title'];?>
                        </a>
                        <span class="as-news-table-list-date">
                            <?php echo setDate($news_list[$i]['registered_dt']); ?>
                            <?php echo $news_list[$i]['link_origin'] ?>
                        </span>
                    <?php } ?>

                </li>
            <?php } ?>

        </ul>

        <?php if(count($news_list) > 0){ ?>
        <div class="as-table-pagination">
            <a href="<?php echo ROOT;?>news.php?page=1" class="as-paging as-paging-first"> << </a>
            <a href="<?php echo ROOT;?>news.php?page=1" class="as-paging as-paging-prev"> << </a>
            <a href="<?php echo ROOT;?>news.php?page=1" class="as-paging as-paging-current">1</a>
<!--            <a href="#" class="as-paging">2</a>-->
<!--            <a href="#" class="as-paging">3</a>-->
            <a href="<?php echo ROOT;?>news.php?page=1" class="as-paging as-paging-next"> > </a>
            <a href="<?php echo ROOT;?>news.php?page=1" class="as-paging as-paging-end"> >> </a>
        </div>
        <?php } ?>
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