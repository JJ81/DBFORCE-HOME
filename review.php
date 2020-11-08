<?php
require_once('./autoload.php');
require_once('./commons/config.php');
require_once('./commons/utils.php');
require_once('./commons/session.php');

define('PAGE','REVIEW');
define('PAGE_NAME', ' 고객성공후기');
define('PAGE_PATH', 'review');

require_once ('./inc/common-data.php');


use JCORP\Business\News\NewsService as News;
$news=new News();

if(!isset($_GET['page'])){
    Redirect(ROOT . 'review.php?page=1');
    exit;
}

if(!is_numeric($_GET['page'])){
    Redirect(ROOT . 'review.php?page=1');
    exit;
}

$page=getDataByGet('page');

if(empty($page)){
    $page=1;
}

$size=12; // 작은 페이지 내의 총 리스트 갯수
$size_per_page=10; // 최대 페이지네이션 갯수
$offset=0;

$total_list_info=$news->getTotalListCount();
$lists=[];

if(!empty($total_list_info[0]['total'])){
    $total_list_count=$total_list_info[0]['total'];
    $total_lg_page_count=ceil($total_list_count/$size_per_page); // 큰 페이지 개수
    $current_lg_page=ceil($page/$size_per_page); // 현재 큰 페이지 위치

    $offset=($page-1)*$size;
//$lists=$notice->getList($offset, $size);
    $lists=$news->getListByNature($offset, $size);


    $total_last_page_num=ceil($total_list_count/$size); // 가장 마지막 페이지 번호

    if(ceil($page/$size_per_page) <= 1){
        $current_start_page_num=1;
    }else{
        $current_start_page_num=(ceil($page/$size_per_page)-1) + ($size_per_page*($current_lg_page-1)); // 현재에서 시작 페이지 번호 == $current_lg_page
    }


// 현재에서 표기해야할 마지막 페이지 번호
    if($total_last_page_num > $size_per_page*$current_lg_page){
        $current_last_page_num=$size_per_page*$current_lg_page; // 남으면 최대치를 그리고
    }else{
        $current_last_page_num=$total_last_page_num; // 부족하면 그릴 수 있는 만큼만 그린다.
    }

    $current_next_page=null;
    $current_prev_page=null;

    if( ($page+1) <= $total_last_page_num ){
        $current_next_page=$page+1;
    }else{
        $current_next_page=$total_last_page_num;
    }

    if( ($page-1) > 0 ){
        $current_prev_page=$page-1;
    }else{
        $current_prev_page=1;
    }

// 요청하는 페이지가 총 마지막 페이지보다 클 때
    if($total_last_page_num < $page){
        Redirect(ROOT . 'review.php?page=1');
        exit;
    }


// 정보 확인
    error_log('current_page');
    error_log($page);
    error_log('current_lg_page');
    error_log($current_lg_page);
    error_log('total_lg_page_count');
    error_log($total_lg_page_count);
    error_log('start page num');
    error_log($current_start_page_num);
    error_log('end page num');
    error_log($current_last_page_num);
    error_log('real last page');
    error_log($total_last_page_num);

}



?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <?php require_once('./inc/head.php') ;?>
    <title><?php echo $info[0]['title'];?>, 이용후기</title>
</head>

<body>

<?php require_once('./inc/preloader.php') ;?>

<?php if(isMobile()){ ?>

    <?php require_once ('./inc/vt-header-m.php');?>

    <div id="vt-content-m">
        <div>
            <img src="<?php echo ROOT;?>assets/img/mobile/banner/img-m-ban-review.jpg" alt="" width="100%" />
        </div>

        <?php require_once ('./inc/notice-m.php');?>

        <div style="padding-top: 50px;">
            <img src="<?php echo ROOT;?>assets/img/mobile/img-m-review-title.jpg" alt="" width="100%" />
        </div>

        <table class="vt-group-info-table">
            <?php for($i=0,$size=count($lists);$i<$size;$i++){?>
                <tr>
                    <td>
                        <?php if(empty($lists[$i]['external_link'])){?>
                            <a href="<?php echo ROOT;?>review_view.php?id=<?php echo $lists[$i]['id'];?>">
                                <div style="margin-bottom: 10px;">
                                    <img src="<?php echo ROOT;?>assets/uploads/news/<?php echo $lists[$i]['thumbnail'];?>"
                                         alt="<?php echo replaceQuotationMark($lists[$i]['title']);?>"
                                         width="100%" />
                                </div>

                                <?php echo replaceQuotationMark($lists[$i]['title']);?>
                                <?php
                                $registered_dt=new DateTime($lists[$i]['registered_dt']);
                                $today=new DateTime(getToday('Y-m-d H:i:s'));
                                if(date_diff($registered_dt, $today)->days < 7){?>
                                    <span class="vt-ico-new">NEW</span>
                                <?php } ?>
                            </a>
                        <?php }else{ ?>
                            <a href="<?php echo $lists[$i]['external_link'];?>" target="_blank">
                                <?php echo $lists[$i]['title'];?>
                                <?php
                                $registered_dt=new DateTime($lists[$i]['registered_dt']);
                                $today=new DateTime(getToday('Y-m-d H:i:s'));
                                if(date_diff($registered_dt, $today)->days < 7){?>
                                    <span class="vt-ico-new">NEW</span>
                                <?php } ?>
                            </a>
                        <?php } ?>

                        <div class="vt-group-info-sub" style="margin-top: 5px;padding-bottom: 15px;">
                            <span>작성일 <?php echo setDate($lists[$i]['registered_dt']);?></span>&nbsp;&nbsp;
                            <span>조회수 <?php echo separateCommaNumber($lists[$i]['count']);?></span>
                        </div>

                    </td>
                </tr>
            <?php } ?>
        </table>

        <?php if(count($lists)>0){ ?>
            <div class="vt-table-pagination">
                <a href="<?php echo ROOT;?>review.php?page=1" class="vt-paging vt-paging-first"> << </a>
                <a href="<?php echo ROOT;?>review.php?page=<?php echo $current_prev_page;?>" class="vt-paging vt-paging-prev"> < </a>

                <?php for($p=$current_start_page_num,$size=$current_last_page_num;$p<=$size;$p++){?>
                    <a href="<?php echo ROOT;?>review.php?page=<?php echo $p;?>"
                       class="vt-paging <?php if($page == $p){ echo 'vt-paging-current';};?>"><?php echo $p;?></a>
                <?php } ?>

                <a href="<?php echo ROOT;?>review.php?page=<?php echo $current_next_page;?>" class="vt-paging vt-paging-next"> > </a>
                <a href="<?php echo ROOT;?>review.php?page=<?php echo $total_last_page_num ;?>" class="vt-paging vt-paging-end"> >> </a>
            </div>
        <?php } ?>
    </div>

    <?php require_once ('./inc/vt-footer-m.php');?>
    <?php require_once ('./inc/m-fixed-bottom.php');?>

<?php } else { ?>

    <?php require_once ('./inc/vt-header.php');?>
    <?php require_once ('./inc/notice-pc.php');?>

    <div class="vt-contents">
        <div class="vt-contents-inner">
            <div class="vt-content-header" style="margin-top: 50px;">
                <div class="vt-content-header-title">
                    <img src="./assets/img/img-title-review.jpg" alt="이용후기" width="140" />
                </div>
                <div class="vt-content-header-desc">
                    타임인베스트먼트와 함께 하시는 고객님의 솔직한 후기를 공개합니다.
                </div>
            </div>

            <div class="vt-content-body" style="padding-bottom: 100px;">
                <div class="vt-review">
                    <div class="vt-review-inner clearfix">

                        <?php for($i=0,$size=count($lists);$i<$size;$i++){ ?>
                            <div class="vt-col-2">
                                <div class="vt-review-box">
                                    <div class="vt-review-thumbnail">
                                        <img src="<?php echo ROOT;?>assets/uploads/news/<?php echo $lists[$i]['thumbnail'] ;?>" alt="" width="80%" />
                                    </div>
                                    <div class="vt-review-info" 
                                         style="width: 295px;">
                                        <div class="vt-review-info-title">
                                            <?php echo replaceQuotationMark($lists[$i]['title']);?>
                                        </div>
                                        <div class="vt-review-info-sub">
                                            <?php echo $lists[$i]['author'];?> / <?php echo setDate($lists[$i]['registered_dt']);?>
                                        </div>
                                        <div class="vt-review-btn-area">
                                            <a href="<?php echo ROOT;?>review_view.php?id=<?php echo $lists[$i]['id'];?>" class="vt-review-detail-btn">자세히 보기</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    </div>

                    <?php if(count($lists)>0){ ?>
                        <div class="vt-table-pagination">
                            <a href="<?php echo ROOT;?>review.php?page=1" class="vt-paging vt-paging-first"> << </a>
                            <a href="<?php echo ROOT;?>review.php?page=<?php echo $current_prev_page;?>" class="vt-paging vt-paging-prev"> < </a>

                            <?php for($p=$current_start_page_num,$size=$current_last_page_num;$p<=$size;$p++){?>
                                <a href="<?php echo ROOT;?>review.php?page=<?php echo $p;?>"
                                   class="vt-paging <?php if($page == $p){ echo 'vt-paging-current';};?>"><?php echo $p;?></a>
                            <?php } ?>

                            <a href="<?php echo ROOT;?>review.php?page=<?php echo $current_next_page;?>" class="vt-paging vt-paging-next"> > </a>
                            <a href="<?php echo ROOT;?>review.php?page=<?php echo $total_last_page_num ;?>" class="vt-paging vt-paging-end"> >> </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <?php require_once ('./inc/vt-footer.php');?>
<?php } ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js"></script>
<script src="<?php echo ROOT;?>assets/js/vendors/jquery.tickerNews.min.js"></script>
<script src="<?php echo ROOT;?>assets/common.js?v=<?php echo $info[0]['deploy_version'];?>"></script>

</body>
</html>