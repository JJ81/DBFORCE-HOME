<?php
require_once('./autoload.php');
require_once('./commons/config.php');
require_once('./commons/utils.php');
require_once('./commons/session.php');

define('PAGE','VIP_PROFIT');
define('PAGE_NAME', 'VIP투자성과');
define('PAGE_PATH', 'vip_profit');


require_once ('./inc/common-data.php');


use JCORP\Business\VipProfitService\VipProfitService as VipProfitService;
$inc=new VipProfitService();

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
$probability=0;

$total_list_info=$inc->getTotalListCount();
$lists=[];

if(!empty($total_list_info[0]['total'])){
    $probability_info=$inc->getProbability();
    $plus_profit=$probability_info[0]['profit_rate_plus'];
    $minus_profit=$probability_info[0]['profit_rate_minus'];

    $probability=$plus_profit/($plus_profit+$minus_profit)*100;

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

    // 동일한 이름의 종목수, 누적수익률 총합계, 승률?? 모름
    $stock_count=$inc->getTotalStock();
    $final_stock_count=empty($stock_count)? 0 : $stock_count[0]['total'];

    $stock_rate=$inc->getTotalProfitRate();
    $final_stock_rate=empty($stock_rate)? 0 : $stock_rate[0]['total'];


}

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <?php require_once('./inc/head.php') ;?>
    <title><?php echo $info[0]['title'];?>, <?php echo PAGE_NAME;?></title>
</head>

<body>

<?php require_once('./inc/preloader.php') ;?>

<?php if(isMobile()){ ?>

    <?php require_once ('./inc/vt-header-m.php');?>

    <div id="jp-content-m">
        <div class="jp-page-banner-m">
            <img src="<?php echo ROOT;?>assets/img/mobile/banner/ban-m-vip-profit.jpg" alt="" width="100%" />
        </div>

        <div class="free-profit-m-table-summary-wrp">
            <table class="free-profit-m-table-summary">
                <colgroup>
                    <col width="33.333%" />
                    <col width="33.333%" />
                    <col width="33.333%" />
                </colgroup>
                <thead>
                <tr>
                    <th>매매종목수</th>
                    <th>승률(%)</th>
                    <th>누적수익률(%)</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?php echo separateCommaNumber($final_stock_count);?>종목</td>
                    <td><?php echo number_format($probability,1);?> %</td>
                    <td><?php echo separateCommaNumber($final_stock_rate);?>%</td>
                </tr>
                </tbody>

            </table>
        </div>

        <div class="free-profit-m-table-main-wrp">
            <table class="vt-group-info-table free-profit-m-table-main">
                <colgroup>
                    <col width="20%" />
                    <col width="35%" />
                    <col width="15%" />
                    <col width="15%" />
                    <col width="15%" />
                </colgroup>
                <tr>
                    <th>전문가</th>
                    <th>종목명</th>
                    <th>매입가</th>
                    <th>매도가</th>
                    <th>수익률</th>
                </tr>
                <?php if(count($lists) == 0){ ?>
                    <tr>
                        <td style="padding: 150px 0;text-align: center;" colspan="5">아직 등록된 글이 없습니다.</td>
                    </tr>
                <?php } ?>
                <?php for($i=0,$size=count($lists);$i<$size;$i++){?>
                    <tr>
                        <td><?php echo $lists[$i]['author'];?></td>
                        <td><?php echo $lists[$i]['stock_title'];?></td>
                        <td><?php echo $lists[$i]['purchase_price'];?></td>
                        <td><?php echo $lists[$i]['sell_price'];?></td>
                        <td class="text-red bold700">
                            <?php if(checkContainLetter($lists[$i]['profit_rate'], '-') == true){ ?>
                                <span style="color: #005aa2;"><?php echo $lists[$i]['profit_rate'];?></span>
                            <?php }else{ ?>
                                <span><?php echo $lists[$i]['profit_rate'];?></span>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>


        <?php if(count($lists)>0){ ?>
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
        <?php } ?>
    </div>

    <?php require_once ('./inc/vt-footer-m.php');?>
    <?php require_once ('./inc/m-fixed-bottom.php');?>

<?php } else { ?>
    <?php require_once ('./inc/vt-header-main.php');?>
    <?php require_once ('./inc/notice-common-pc.php');?>

    <div class="contents-pc">

        <div class="page-pc-banner-area">
            <img src="<?php echo ROOT;?>assets/img/banner/pc/img-pc-ban-vip-invest.jpg" alt="" />
        </div>

        <div class="page-pc-tab-area">
            <?php require_once ('./inc/tab-pc-result.php');?>
        </div>

        <div class="page-pc-body-area">
            <div class="page-pc-table-head">
                한국경제투자TV <span class="red-emphasis">VIP 투자성과</span>
            </div>

            <div class="page-pc-table-body-wrp">
                <div style="margin-bottom: 20px;">
                    <table class="free-profit-m-table-summary">
                        <colgroup>
                            <col width="33.333%" />
                            <col width="33.333%" />
                            <col width="33.333%" />
                        </colgroup>
                        <thead>
                        <tr>
                            <th>매매종목수</th>
                            <th>승률(%)</th>
                            <th>누적수익률(%)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><?php echo separateCommaNumber($final_stock_count);?>종목</td>
                            <td><?php echo number_format($probability,1);?> %</td>
                            <td><?php echo separateCommaNumber($final_stock_rate);?>%</td>
                        </tr>
                        </tbody>

                    </table>
                </div>


                <table class="vt-group-info-table free-profit-m-table-main">
                    <colgroup>
                        <col width="*" />
                        <col width="*" />
                        <col width="*" />
                        <col width="*" />
                        <col width="*" />
                        <col width="*" />
                        <col width="*" />
                    </colgroup>
                    <tr>
                        <th>전문가</th>
                        <th>종목명</th>
                        <th>매일일</th>
                        <th>매입가</th>
                        <th>매도일</th>
                        <th>매도가</th>
                        <th>수익률</th>
                    </tr>
                    <?php if(count($lists) == 0){ ?>
                        <tr>
                            <td style="padding: 150px 0;text-align: center;" colspan="7">아직 등록된 글이 없습니다.</td>
                        </tr>
                    <?php } ?>
                    <?php for($i=0,$size=count($lists);$i<$size;$i++){?>
                        <tr>
                            <td><?php echo $lists[$i]['author'];?></td>
                            <td><?php echo $lists[$i]['stock_title'];?></td>
                            <td><?php echo $lists[$i]['purchase_date'];?></td>
                            <td><?php echo $lists[$i]['purchase_price'];?></td>
                            <td><?php echo $lists[$i]['sell_date'];?></td>
                            <td><?php echo $lists[$i]['sell_price'];?></td>
                            <td class="text-red bold700">
                                <?php if(checkContainLetter($lists[$i]['profit_rate'], '-') == true){ ?>
                                    <span style="color: #005aa2;"><?php echo $lists[$i]['profit_rate'];?></span>
                                <?php }else{ ?>
                                    <span><?php echo $lists[$i]['profit_rate'];?></span>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>

            <?php if(count($lists) > 0){ ?>
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
            <?php } ?>

        </div>
    </div>

    <?php require_once ('./inc/vt-footer.php');?>
<?php } ?>

<?php require_once ('./inc/foot.php');?>

</body>
</html>