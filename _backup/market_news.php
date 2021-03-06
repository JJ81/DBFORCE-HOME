<?php
require_once('./autoload.php');
require_once('./commons/config.php');
require_once('./commons/utils.php');
require_once('./commons/session.php');

define('PAGE','MARKET_NEWS');
define('PAGE_NAME', '장전뉴스');
define('PAGE_PATH', 'market_news');


require_once('./inc/common-data.php');


use JCORP\Business\MarketNewsService\MarketNewsService as MarketNews;
$inc=new MarketNews();

if(!isset($_GET['page'])){
    Redirect(ROOT . PAGE_PATH . '.php?page=1');
    exit;
}

if(!is_numeric($_GET['page'])){
    Redirect(ROOT . PAGE_PATH . '.php?page=1');
    exit;
}

$page=getDataByGet('page');

if(empty($page)){
    $page=1;
}

$size=20; // 작은 페이지 내의 총 리스트 갯수
$size_per_page=10; // 최대 페이지네이션 갯수
$offset=0;

if(isMobile()){
    $size_per_page=5; // 모바일에서는 5개로 제한함.
}

$total_list_info=$inc->getTotalListCount();
$lists=[];

if(!empty($total_list_info[0]['total'])){
    $total_list_count=$total_list_info[0]['total'];
    $total_lg_page_count=ceil($total_list_count/$size_per_page); // 큰 페이지 개수
    $current_lg_page=ceil($page/$size_per_page); // 현재 큰 페이지 위치

    $offset=($page-1)*$size;
    $lists=$inc->getList($offset, $size);

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
        Redirect(ROOT . PAGE_PATH . '.php?page=1');
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
    <?php require_once('./inc/head.php');?>
    <title><?php echo $info[0]['title'];?>, <?php echo PAGE_NAME;?></title>
</head>

<body>

<?php require_once('./inc/preloader.php');?>

<?php if(isMobile()){ ?>

    <?php require_once('./inc/vt-header-m.php');?>

    <div id="jp-content-m">
        <div class="jp-page-banner-m">
            <img src="<?php echo ROOT;?>assets/img/mobile/banner/ban-m-market-news.jpg" alt="" width="100%" />
        </div>
        <table class="vt-group-info-table">
            <?php for($i=0,$size=count($lists);$i<$size;$i++){?>
                <tr>
                    <td>
                        <?php if(empty($lists[$i]['external_link'])){?>
                            <a href="<?php echo ROOT;?><?php echo PAGE_PATH;?>_view.php?id=<?php echo $lists[$i]['id'];?>">
                                <?php echo replaceQuotationMark($lists[$i]['title']);?>
                                <?php
                                $registered_dt=new DateTime($lists[$i]['registered_dt']);
                                $today=new DateTime(getToday('Y-m-d H:i:s'));
                                if(date_diff($registered_dt, $today)->days < 7){?>
                                    <span class="ico-new">NEW</span>
                                <?php } ?>
                            </a>
                        <?php }else{ ?>
                            <a href="<?php echo $lists[$i]['external_link'];?>" target="_blank">
                                <?php echo $lists[$i]['title'];?>
                                <?php
                                $registered_dt=new DateTime($lists[$i]['registered_dt']);
                                $today=new DateTime(getToday('Y-m-d H:i:s'));
                                if(date_diff($registered_dt, $today)->days < 7){?>
                                    <span class="ico-new">NEW</span>
                                <?php } ?>
                            </a>
                        <?php } ?>

                        <div class="vt-group-info-sub" style="margin-top: 5px;padding-bottom: 15px;">
                            <span>작성일 <?php echo setDate($lists[$i]['registered_dt']);?></span>
                            <span class="splitter">|</span>
                            <span>조회수 <?php echo separateCommaNumber($lists[$i]['count']);?></span>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </table>

        <div class="vt-table-pagination">
            <a href="<?php echo ROOT;?><?php echo PAGE_PATH;?>.php?page=1" class="vt-paging vt-paging-first"> << </a>
            <a href="<?php echo ROOT;?><?php echo PAGE_PATH;?>.php?page=<?php echo $current_prev_page;?>" class="vt-paging vt-paging-prev"> < </a>

            <?php for($p=$current_start_page_num,$size=$current_last_page_num;$p<=$size;$p++){?>
                <a href="<?php echo ROOT;?><?php echo PAGE_PATH;?>.php?page=<?php echo $p;?>"
                   class="vt-paging <?php if($page == $p){ echo 'vt-paging-current';};?>"><?php echo $p;?></a>
            <?php } ?>

            <a href="<?php echo ROOT;?><?php echo PAGE_PATH;?>.php?page=<?php echo $current_next_page;?>" class="vt-paging vt-paging-next"> > </a>
            <a href="<?php echo ROOT;?><?php echo PAGE_PATH;?>.php?page=<?php echo $total_last_page_num ;?>" class="vt-paging vt-paging-end"> >> </a>
        </div>
    </div>

    <?php require_once('./inc/vt-footer-m.php');?>
    <?php require_once('./inc/m-fixed-bottom.php');?>

<?php } else { ?>
    <?php require_once('./inc/vt-header-main.php');?>
    <?php require_once('./inc/notice-common-pc.php');?>

    <div class="contents-pc">

        <div class="page-pc-banner-area">
            <img src="<?php echo ROOT;?>assets/img/banner/pc/img-pc-ban-market-news.jpg" alt="" />
        </div>

        <div class="page-pc-tab-area">
            <?php require_once('./inc/tab-pc-invest.php');?>
        </div>

        <div class="page-pc-body-area">
            <div class="page-pc-table-head">
                한국경제투자TV <span class="red-emphasis">장전뉴스</span>
            </div>

            <div class="page-pc-table-body-wrp">
                <table class="page-pc-table-body page-table-col-type-a">
                    <thead>
                    <tr>
                        <th>번호</th>
                        <th>제목</th>
                        <th>작성자</th>
                        <th>작성일</th>
                        <th>조회수</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php for($i=0,$size=count($lists);$i<$size;$i++){?>
                        <tr>
                            <td>
                                <span><?php echo $lists[$i]['id'];?></span>
                            </td>
                            <td>
                                <?php if(empty($lists[$i]['external_link'])){?>
                                    <a href="<?php echo ROOT;?><?php echo PAGE_PATH;?>_view.php?id=<?php echo $lists[$i]['id'];?>">
                                        <?php echo replaceQuotationMark($lists[$i]['title']);?>
                                        <?php
                                        $registered_dt=new DateTime($lists[$i]['registered_dt']);
                                        $today=new DateTime(getToday('Y-m-d H:i:s'));
                                        if(date_diff($registered_dt, $today)->days < 7){?>
                                            <span class="ico-new">NEW</span>
                                        <?php } ?>
                                    </a>
                                <?php }else{ ?>
                                    <a href="<?php echo $lists[$i]['external_link'];?>" target="_blank">
                                        <?php echo $lists[$i]['title'];?>
                                        <?php
                                        $registered_dt=new DateTime($lists[$i]['registered_dt']);
                                        $today=new DateTime(getToday('Y-m-d H:i:s'));
                                        if(date_diff($registered_dt, $today)->days < 7){?>
                                            <span class="ico-new">NEW</span>
                                        <?php } ?>
                                    </a>
                                <?php } ?>
                            </td>
                            <td>
                                <span><?php echo $lists[$i]['author'];?></span>
                            </td>
                            <td>
                                <span><?php echo setDate($lists[$i]['registered_dt']);?></span>
                            </td>
                            <td>
                                <span><?php echo separateCommaNumber($lists[$i]['count']);?></span>
                            </td>
                        </tr>
                    <?php } ?>

                    </tbody>
                </table>
            </div>

            <div class="page-pc-table-paging">
                <div class="vt-table-pagination">
                    <a href="<?php echo ROOT;?><?php echo PAGE_PATH;?>.php?page=1" class="vt-paging vt-paging-first"> << </a>
                    <a href="<?php echo ROOT;?><?php echo PAGE_PATH;?>.php?page=<?php echo $current_prev_page;?>" class="vt-paging vt-paging-prev"> < </a>

                    <?php for($p=$current_start_page_num,$size=$current_last_page_num;$p<=$size;$p++){?>
                        <a href="<?php echo ROOT;?><?php echo PAGE_PATH;?>.php?page=<?php echo $p;?>"
                           class="vt-paging <?php if($page == $p){ echo 'vt-paging-current';};?>"><?php echo $p;?></a>
                    <?php } ?>

                    <a href="<?php echo ROOT;?><?php echo PAGE_PATH;?>.php?page=<?php echo $current_next_page;?>" class="vt-paging vt-paging-next"> > </a>
                    <a href="<?php echo ROOT;?><?php echo PAGE_PATH;?>.php?page=<?php echo $total_last_page_num ;?>" class="vt-paging vt-paging-end"> >> </a>
                </div>
            </div>


        </div>
    </div>

    <?php require_once('./inc/vt-footer.php');?>
<?php } ?>

<?php require_once('./inc/foot.php');?>

</body>
</html>