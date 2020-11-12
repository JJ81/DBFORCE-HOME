<?php
require_once('./autoload.php');
require_once('./commons/config.php');
require_once('./commons/utils.php');
require_once('./commons/session.php');

define('PAGE','MAIN');
define('PAGE_NAME', '메인페이지');
define('PAGE_PATH', 'main');

require_once('./inc/common-data.php');

// 4. 공지사항 5개
$notice_lists2=$notice->getList(0, 5); // 최신글 5개

// 5. 기사보도 5개
use JCORP\Business\Media\MediaService as Media;
$media=new Media();
$media_lists=$media->getList(0, 5);

// 6. 장전뉴스 5개
use JCORP\Business\MarketNewsService\MarketNewsService as MarketNews;
$market_news=new MarketNews();
$market_news_lists=$market_news->getList(0, 5);

// 7. 베스트 수익 후기 최근 글 3개 가져오기
use JCORP\Business\BestProfitService\BestProfitService as BestProfit;
$best_profit=new BestProfit();
$best_profit_lists=$best_profit->getList(0, 3);

// 8. 실시간 수익 인증글 가져오기
use JCORP\Business\MemberProfitService\MemberProfitService as MemberProfitService;
$member_profit=new MemberProfitService();
$member_profit_lists=$member_profit->getList(0, 5);


// 9. 무료체험투자성과 가져오기
use JCORP\Business\FreeProfitService\FreeProfitService as FreeProfit;
$free_profit=new FreeProfit();
$free_profit_lists=$free_profit->getList(0,5);


// 10. VIP투자성과 가져오기
use JCORP\Business\VipProfitService\VipProfitService as VipProfit;
$vip_profit=new VipProfit();
$vip_profit_lists=$vip_profit->getList(0,5);

// 투자성과 보러가기 이미지

// 투자성과 이미지 정보 가져오기

// 진행중인 투자서비스 이미지 가져오기

// 이벤트 가져오기
use JCORP\Business\EventService\EventService as EventProfit;
$event_inc=new EventProfit();
$event_lists=$event_inc->getList(0,3);



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

        <div id="jp-content-m">

            <!-- main banner -->
            <div id="jp-banner-area-m">
                <div class="swiper-container vt-swiper-container-home-banner">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="<?php echo ROOT;?>assets/img/mobile/banner/banner-m-02.jpg" alt="" style="width: 100%;" />
                        </div>
                        <div class="swiper-slide">
                            <img src="<?php echo ROOT;?>assets/img/mobile/banner/banner-m-03.jpg" alt="" style="width: 100%;" />
                        </div>
                        <div class="swiper-slide">
                            <img src="<?php echo ROOT;?>assets/img/mobile/banner/banner-m-04.jpg" alt="" style="width: 100%;" />
                        </div>
                        <div class="swiper-slide">
                            <img src="<?php echo ROOT;?>assets/img/mobile/banner/banner-m-05.jpg" alt="" style="width: 100%;" />
                        </div>
                        <div class="swiper-slide">
                            <img src="<?php echo ROOT;?>assets/img/mobile/banner/banner-m-01.jpg" alt="" style="width: 100%;" />
                        </div>
                    </div>
                    <div class="swiper-pagination vt-swiper-pagination-home-banner" style="bottom: 10px;"></div>
                </div>
            </div>

            <!-- 무료체험신청현황 -->
            <div class="vt-free-request-stream vt-free-request-stream-m">
                <div class="vt-free-request-stream-inner clearfix">
                    <div class="ti-notice-stream">
                        <div class="vt-free-request-title">
                            <span style="position: relative; top: 6px;">
                               <strong style="display: block;font-size: 14px;"> <?php echo $today_month;?>/<?php echo $today_day;?></strong>
                                <span style="color: #faee18;">유료서비스</span>
                                신청
                            </span>
                        </div>

                        <div class="vt-free-request-lists">
                            <div class="TickerNews" id="T1">
                                <div class="ti_wrapper">
                                    <div class="ti_slide clearfix">
                                        <div class="ti_content">
                                            <?php for($fe=0,$size_fe=count($free_req_lists);$fe<$size_fe;$fe++){ ?>
                                                <div class="ti_news">
                                                    <?php echo $free_req_lists[$fe]['user_name'];?>(<?php echo $free_req_lists[$fe]['tel_end'];?>)님 신청완료
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div>
                <a href="<?php echo EVENT_PAGE_URL;?>" target="_blank">
                    <img src="<?php echo ROOT;?>assets/img/mobile/banner/btn-img-landing-01.jpg" alt="" width="100%" />
                </a>
            </div>

            <!-- 공지 / 기사보도 / 장전뉴스 -->
            <div id="main-board-01">
                <div class="main-board-01-inner">
                    <div class="main-board-tab-wrp">
                        <ul class="main-board-tab-body clearfix">
                            <li class="main-board-tab-list">
                                <a href="#" class="main-board-tab-link active">장전뉴스</a>
                            </li>
                            <li class="main-board-tab-list">
                                <a href="#" class="main-board-tab-link">언론보도</a>
                            </li>
                            <li class="main-board-tab-list">
                                <a href="#" class="main-board-tab-link">공지사항</a>
                            </li>
                        </ul>
                    </div>

                    <div class="main-board-container">
                        <!-- 장전뉴스 -->
                        <div class="main-board-con main-board-con-01">
                            <ul class="main-board-con-body">

                                <?php for($mn=0,$size_mn=count($market_news_lists);$mn<$size_mn;$mn++){ ?>
                                    <li class="main-board-con-list">
                                        <a href="market_news_view.php?id=<?php echo $market_news_lists[$mn]['id'];?>" class="main-board-con-link">
                                            <?php echo $market_news_lists[$mn]['title'];?>

                                            <?php
                                            $registered_dt=new DateTime($market_news_lists[$mn]['registered_dt']);
                                            $today=new DateTime(getToday('Y-m-d H:i:s'));
                                            if(date_diff($registered_dt, $today)->days < 7){?>
                                                <small class="ico-new ico-new-01">NEW</small>
                                            <?php } ?>
                                        </a>
                                    </li>
                                <?php } ?>

                            </ul>
                            <div class="main-board-con-btn-area">
                                <a href="market_news.php" class="main-board-con-btn-more">더보기</a>
                            </div>
                        </div>

                        <!-- 언론보도 -->
                        <div class="main-board-con main-board-con-02">
                            <ul class="main-board-con-body">
                                <?php for($ml=0,$size_ml=count($media_lists);$ml<$size_ml;$ml++){ ?>
                                    <li class="main-board-con-list">
                                        <a href="media_view.php?id=<?php echo $media_lists[$ml]['id'];?>" class="main-board-con-link">
                                            <?php echo $media_lists[$ml]['title'];?>

                                            <?php
                                            $registered_dt=new DateTime($media_lists[$ml]['registered_dt']);
                                            $today=new DateTime(getToday('Y-m-d H:i:s'));
                                            if(date_diff($registered_dt, $today)->days < 7){?>
                                                <small class="ico-new ico-new-01">NEW</small>
                                            <?php } ?>
                                        </a>
                                    </li>
                                <?php } ?>

                            </ul>
                            <div class="main-board-con-btn-area">
                                <a href="media.php" class="main-board-con-btn-more">더보기</a>
                            </div>
                        </div>

                        <!-- 공지사항 -->
                        <div class="main-board-con main-board-con-03">
                            <ul class="main-board-con-body">
                                <?php for($nl2=0,$size_nl2=count($notice_lists2);$nl2<$size_nl2;$nl2++){ ?>
                                <li class="main-board-con-list">
                                    <a href="notice_view.php?id=<?php echo $notice_lists2[$nl2]['id'];?>" class="main-board-con-link">
                                        <?php echo $notice_lists2[$nl2]['title'];?>

                                        <?php
                                        $registered_dt=new DateTime($notice_lists2[$nl2]['registered_dt']);
                                        $today=new DateTime(getToday('Y-m-d H:i:s'));
                                        if(date_diff($registered_dt, $today)->days < 7){?>
                                            <small class="ico-new ico-new-01">NEW</small>
                                        <?php } ?>
                                    </a>
                                </li>
                                <?php } ?>
                            </ul>
                            <div class="main-board-con-btn-area">
                                <a href="notice.php" class="main-board-con-btn-more">더보기</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div>
                <a href="<?php echo YOUTUBE_URL;?>" target="_blank">
                    <img src="<?php echo ROOT;?>assets/img/mobile/banner/btn-m-youtube.jpg" alt="" width="100%" />
                </a>
            </div>

            <!-- 베스트 수익 후기 -->
            <div id="best-profit-m">
                <div class="best-profit-m-inner">
                    <div class="best-profit-m-head">
                        <img src="<?php echo ROOT;?>assets/img/mobile/img-m-best-profit.jpg" alt="" width="100%" />
                    </div>
                    <div class="best-profit-m-body">
                        <!-- swiper -->
                        <div class="swiper-container vt-swiper-container-home-best">
                            <div class="swiper-wrapper">
                                <?php for($bl=0,$size_bl=count($best_profit_lists);$bl<$size_bl;$bl++){ ?>
                                    <div class="swiper-slide">
                                        <a href="best_profit_view.php?id=<?php echo $best_profit_lists[$bl]['id'];?>" style="margin: 0 32px;display: block;">
                                            <img src="<?php echo ROOT;?>assets/uploads/best_profit/<?php echo $best_profit_lists[$bl]['thumbnail'];?>" alt="" style="width: 100%;" />
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="main-board-02">
                <div class="main-board-02-inner">
                    <div class="main-board-tab-wrp">
                        <ul class="main-board-tab-body clearfix">
                            <li class="main-board-tab-list">
                                <a href="#" class="main-board-tab-link active">실시간수익인증</a>
                            </li>
                            <li class="main-board-tab-list">
                                <a href="#" class="main-board-tab-link">블랙멤버쉽투자성과</a>
                            </li>
                            <li class="main-board-tab-list">
                                <a href="#" class="main-board-tab-link">VIP투자성과</a>
                            </li>
                        </ul>
                    </div>

                    <div class="main-board-container">
                        <!-- 실시간수익인증 -->
                        <div class="main-board-con main-board-con-01">
                            <ul class="main-board-con-body">
                                <?php if(count($member_profit_lists) == 0){ ?>
                                    <li class="main-board-con-list" style="height: 217px;line-height:217px;text-align: center;font-size: 13px;color: #999;">
                                        아직 등록된 글이 없습니다.
                                    </li>
                                <?php } ?>
                                <?php for($mp=0,$size_mp=count($member_profit_lists);$mp<$size_mp;$mp++){ ?>
                                    <li class="main-board-con-list">
                                        <a href="market_news_view.php?id=<?php echo $member_profit_lists[$mp]['id'];?>" class="main-board-con-link">
                                            <?php echo $member_profit_lists[$mp]['title'];?>

                                            <?php
                                            $registered_dt=new DateTime($member_profit_lists[$mp]['registered_dt']);
                                            $today=new DateTime(getToday('Y-m-d H:i:s'));
                                            if(date_diff($registered_dt, $today)->days < 7){?>
                                                <small class="ico-new ico-new-01">NEW</small>
                                            <?php } ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                            <?php if(count($member_profit_lists) > 0){ ?>
                                <div class="main-board-con-btn-area">
                                    <a href="member_profit.php" class="main-board-con-btn-more">더보기</a>
                                </div>
                            <?php } ?>
                        </div>

                        <!-- 무료체험투자성과 -->
                        <div class="main-board-con main-board-con-02">
                            <ul class="main-board-con-body">
                                <li class="main-board-con-list" style="border: none;">
                                    <table class="jp-table-m">
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
                                        <?php if(count($free_profit_lists) == 0){ ?>
                                            <tr>
                                                <td colspan="5" style="border: none;">
                                                    <div style="height: 177px;line-height:177px;text-align: center;font-size: 13px;color: #999;">
                                                        아직 등록된 글이 없습니다.
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <?php for($fp=0,$size_fp=count($free_profit_lists);$fp<$size_fp;$fp++){ ?>
                                            <tr>
                                                <td><?php echo $free_profit_lists[$fp]['author'];?></td>
                                                <td><?php echo $free_profit_lists[$fp]['stock_title'];?></td>
                                                <td><?php echo $free_profit_lists[$fp]['purchase_price'];?></td>
                                                <td><?php echo $free_profit_lists[$fp]['sell_price'];?></td>
                                                <td class="text-red bold700"><?php echo $free_profit_lists[$fp]['profit_rate'];?></td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </li>
                            </ul>
                            <?php if(count($free_profit_lists) > 0){ ?>
                                <div class="main-board-con-btn-area">
                                    <a href="free_profit.php" class="main-board-con-btn-more">더보기</a>
                                </div>
                            <?php } ?>
                        </div>

                        <!-- VIP 투자성과 -->
                        <div class="main-board-con main-board-con-03">
                            <ul class="main-board-con-body">
                                <li class="main-board-con-list" style="border: none;">
                                    <table class="jp-table-m">
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
                                        <?php if(count($vip_profit_lists) == 0){ ?>
                                        <tr>
                                            <td colspan="5" style="border: none;">
                                                <div style="height: 177px;line-height:177px;text-align: center;font-size: 13px;color: #999;">
                                                    아직 등록된 글이 없습니다.
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        <?php for($vp=0,$size_vp=count($vip_profit_lists);$vp<$size_vp;$vp++){ ?>
                                            <tr>
                                                <td><?php echo $vip_profit_lists[$vp]['author'];?></td>
                                                <td><?php echo $vip_profit_lists[$vp]['stock_title'];?></td>
                                                <td><?php echo $vip_profit_lists[$vp]['purchase_price'];?></td>
                                                <td><?php echo $vip_profit_lists[$vp]['sell_price'];?></td>
                                                <td class="text-red bold700"><?php echo $vip_profit_lists[$vp]['profit_rate'];?></td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </li>
                            </ul>
                            <?php if(count($vip_profit_lists) > 0){ ?>
                                <div class="main-board-con-btn-area">
                                    <a href="notice.php" class="main-board-con-btn-more">더보기</a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 투자성과관련 -->
            <div>
                <div>
                    <img src="<?php echo ROOT;?>assets/img/mobile/img-tit-m-result.jpg" alt="" width="100%" />
                </div>
                <div>
                    <a href="free_profit.php?page=1">
                        <img src="<?php echo ROOT;?>assets/img/banner/img-result-shortcut-profit.jpg?v=1" alt="" width="100%" />
                    </a>
                </div>
                <div style="padding: 20px 0;background: #0c0904;">
                    <div class="best-profit-m-body">
                        <!-- swiper -->
                        <div class="swiper-container vt-swiper-container-home-best">
                            <div class="swiper-wrapper">
                                <?php for($bl=0,$size_bl=count($best_profit_lists);$bl<$size_bl;$bl++){ ?>
                                    <div class="swiper-slide">
                                        <a href="free_profit.php?page=1" style="margin: 0 32px;display: block;">
                                            <img src="<?php echo ROOT;?>assets/img/banner/tmp_profit_result_01.jpg?v=2" alt="" width="100%" />
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="free_profit.php?page=1" style="margin: 0 32px;display: block;">
                                            <img src="<?php echo ROOT;?>assets/img/banner/tmp_profit_result_02.jpg?v=2" alt="" width="100%" />
                                        </a>
                                    </div>
                                    <div class="swiper-slide">
                                        <a href="free_profit.php?page=1" style="margin: 0 32px;display: block;">
                                            <img src="<?php echo ROOT;?>assets/img/banner/tmp_profit_result_03.jpg?v=2" alt="" width="100%" />
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 진행중인 투자 서비스-->
            <div>
                <div>
                    <img src="<?php echo ROOT;?>assets/img/mobile/current-invest-tit-m.jpg" alt="" width="100%" />
                </div>

                <div class="current-service-m-wrp clearfix">
                    <div class="current-service-m-list">
                        <a href="vip.php" class="current-service-m-link">
                            <div class="current-service-body">
                                <div class="service-thumbnail-wrp">
                                    <img src="<?php echo ROOT;?>assets/img/invest_service/gold.png" alt="" width="100%" />
                                </div>
                                <div class="service-title">
                                    GOLD 투자서비스
                                </div>
                                <div class="service-detail-info clearfix">
                                    <div class="service-detail-box">
                                        <div class="upper">
                                            서비스 기간
                                        </div>
                                        <div class="downer">
                                            3개월
                                        </div>
                                    </div>
                                    <div class="service-detail-box">
                                        <div class="upper">
                                            추천 투자금
                                        </div>
                                        <div class="downer">
                                            1천만원 이하
                                        </div>
                                    </div>
                                    <div class="service-detail-box">
                                        <div class="upper">
                                            투자유형
                                        </div>
                                        <div class="downer">
                                            단기/스윙
                                        </div>
                                    </div>
                                </div>
                                <div class="service-status">
                                    <div class="service-status-01 clearfix">
                                        <span class="left">서비스이용자(1000명 제한)</span>
                                        <span class="right">30%</span>
                                    </div>
                                    <div class="service-status-02">
                                        <div class="gauge"><div class="gauge-inner" style="width: 52%"></div></div>
                                    </div>
                                    <div class="service-status-03 clearfix">
                                        <span class="left"><span class="txt-red">520명</span> / 1,000명</span>
                                        <span class="right">모집중</span>
                                    </div>
                                </div>
                            </div>
                            <div class="current-service-foot">
                                <span class="btn-details-link">자세히 보기</span>
                            </div>
                        </a>
                    </div>
                    <div class="current-service-m-list">
                        <a href="vip.php" class="current-service-m-link">
                            <div class="current-service-body">
                                <div class="service-thumbnail-wrp">
                                    <img src="<?php echo ROOT;?>assets/img/invest_service/vip.png" alt="" width="100%" />
                                </div>
                                <div class="service-title">
                                    VIP 투자서비스
                                </div>
                                <div class="service-detail-info clearfix">
                                    <div class="service-detail-box">
                                        <div class="upper">
                                            서비스 기간
                                        </div>
                                        <div class="downer">
                                            12개월
                                        </div>
                                    </div>
                                    <div class="service-detail-box">
                                        <div class="upper">
                                            추천 투자금
                                        </div>
                                        <div class="downer">
                                            3천만원 이하
                                        </div>
                                    </div>
                                    <div class="service-detail-box">
                                        <div class="upper">
                                            투자유형
                                        </div>
                                        <div class="downer">
                                            정보주/일정주
                                        </div>
                                    </div>
                                </div>
                                <div class="service-status">
                                    <div class="service-status-01 clearfix">
                                        <span class="left">서비스이용자(600명 제한)</span>
                                        <span class="right">33%</span>
                                    </div>
                                    <div class="service-status-02">
                                        <div class="gauge"><div class="gauge-inner" style="width: 33%"></div></div>
                                    </div>
                                    <div class="service-status-03 clearfix">
                                        <span class="left"><span class="txt-red">198명</span> / 600명</span>
                                        <span class="right">모집중</span>
                                    </div>
                                </div>
                            </div>
                            <div class="current-service-foot">
                                <span class="btn-details-link">자세히 보기</span>
                            </div>
                        </a>
                    </div>
                    <div class="current-service-m-list">
                        <a href="vip.php" class="current-service-m-link">
                            <div class="current-service-body">
                                <div class="service-thumbnail-wrp">
                                    <img src="<?php echo ROOT;?>assets/img/invest_service/platinum.png" alt="" width="100%" />
                                </div>
                                <div class="service-title">
                                    PLATINUM 투자서비스
                                </div>
                                <div class="service-detail-info clearfix">
                                    <div class="service-detail-box">
                                        <div class="upper">
                                            서비스 기간
                                        </div>
                                        <div class="downer">
                                            12개월
                                        </div>
                                    </div>
                                    <div class="service-detail-box">
                                        <div class="upper">
                                            추천 투자금
                                        </div>
                                        <div class="downer">
                                            5천만원 이하
                                        </div>
                                    </div>
                                    <div class="service-detail-box">
                                        <div class="upper">
                                            투자유형
                                        </div>
                                        <div class="downer">
                                            장기주/세력주
                                        </div>
                                    </div>
                                </div>
                                <div class="service-status">
                                    <div class="service-status-01 clearfix">
                                        <span class="left">서비스이용자(300명 제한)</span>
                                        <span class="right">19%</span>
                                    </div>
                                    <div class="service-status-02">
                                        <div class="gauge"><div class="gauge-inner" style="width: 19%"></div></div>
                                    </div>
                                    <div class="service-status-03 clearfix">
                                        <span class="left"><span class="txt-red">57명</span> / 300명</span>
                                        <span class="right">모집중</span>
                                    </div>
                                </div>
                            </div>
                            <div class="current-service-foot">
                                <span class="btn-details-link">자세히 보기</span>
                            </div>
                        </a>
                    </div>
                    <div class="current-service-m-list">
                        <a href="vip.php" class="current-service-m-link">
                            <div class="current-service-body">
                                <div class="service-thumbnail-wrp">
                                    <img src="<?php echo ROOT;?>assets/img/invest_service/firstclass.png" alt="" width="100%" />
                                </div>
                                <div class="service-title">
                                    FIRST CLASS 고액자산가
                                </div>
                                <div class="service-detail-info clearfix">
                                    <div class="service-detail-box">
                                        <div class="upper">
                                            서비스 기간
                                        </div>
                                        <div class="downer">
                                            12개월
                                        </div>
                                    </div>
                                    <div class="service-detail-box">
                                        <div class="upper">
                                            추천 투자금
                                        </div>
                                        <div class="downer">
                                            1억원 이하
                                        </div>
                                    </div>
                                    <div class="service-detail-box">
                                        <div class="upper">
                                            투자유형
                                        </div>
                                        <div class="downer">
                                            고액자산가
                                        </div>
                                    </div>
                                </div>
                                <div class="service-status">
                                    <div class="service-status-01 clearfix">
                                        <span class="left">서비스이용자(100명 제한)</span>
                                        <span class="right">3%</span>
                                    </div>
                                    <div class="service-status-02">
                                        <div class="gauge"><div class="gauge-inner" style="width: 3%"></div></div>
                                    </div>
                                    <div class="service-status-03 clearfix">
                                        <span class="left"><span class="txt-red">3명</span> / 100명</span>
                                        <span class="right">모집중</span>
                                    </div>
                                </div>
                            </div>
                            <div class="current-service-foot">
                                <span class="btn-details-link">자세히 보기</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div>
                <!-- 이달의 매매내역 -->
<!--                <img src="--><?php //echo ROOT;?><!--assets/img/mobile/tmp/tmp_report_01.jpg" alt="" width="100%" />-->
                <img src="<?php echo ROOT;?>assets/img/tmp/tmp-under-construction.png" alt="" width="100%" />
            </div>

            <div style="padding: 20px 20px 0;">
                <div>
                    <img src="<?php echo ROOT;?>assets/img/mobile/img-m-summary.jpg?v=1" alt="" width="100%" />
                </div>
                <div style="margin: 20px 0;">
                    <a href="vip.php">
                        <img src="<?php echo ROOT;?>assets/img/mobile/btn-m-vip-info.jpg" alt="" width="100%" />
                    </a>
                </div>
                <div>
                    <a href="company.php">
                        <img src="<?php echo ROOT;?>assets/img/mobile/btn-m-refund-info.jpg" alt="" width="100%" />
                    </a>
                </div>
            </div>

            <div style="padding: 0 20px 0;">
                <div style="margin-bottom: 10px;">
                    <img src="<?php echo ROOT;?>assets/img/mobile/img-title-m-system.jpg" alt="" width="100%" />
                </div>

                <a href="philosophy.php">
                    <img src="<?php echo ROOT;?>assets/img/mobile/btn-quick-m-01.jpg" alt="" width="100%" />
                </a>
                <a href="strategy.php" style="margin: 10px 0;display: block;">
                    <img src="<?php echo ROOT;?>assets/img/mobile/btn-quick-m-02.jpg" alt="" width="100%" />
                </a>
                <a href="refund.php">
                    <img src="<?php echo ROOT;?>assets/img/mobile/btn-quick-m-03.jpg" alt="" width="100%" />
                </a>
            </div>

            <div style="padding: 0 20px 30px" class="event-mobile-main">
                <div style="margin-bottom: 10px;">
                    <img src="<?php echo ROOT;?>assets/img/mobile/img-tit-m-event.jpg" alt="" width="100%" />
                </div>

                <?php if(count($event_lists) == 0){ ?>
                    <div class="event-main-area-body clearfix">
                        <div class="event-main-box">
                            <a href="javascript:alert('준비중입니다.');">
                                <img src="<?php echo ROOT;?>assets/img/tmp/img-tmp-event.jpg" alt="" width="100%" />
                            </a>
                        </div>
                        <div class="event-main-box">
                            <a href="javascript:alert('준비중입니다.');">
                                <img src="<?php echo ROOT;?>assets/img/tmp/img-tmp-event.jpg" alt="" width="100%" />
                            </a>
                        </div>
                        <div class="event-main-box">
                            <a href="javascript:alert('준비중입니다.');">
                                <img src="<?php echo ROOT;?>assets/img/tmp/img-tmp-event.jpg" alt="" width="100%" />
                            </a>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="event-main-area-body clearfix">
                        <?php for($el=0,$size_el=count($event_lists);$el<$size_el;$el++){ ?>
                            <div class="event-main-box">
                                <a href="event_view.php?id=<?php echo $event_lists[$el]['id'];?>">
                                    <img src="<?php echo ROOT;?>assets/uploads/event/<?php echo $event_lists[$el]['thumbnail'];?>" alt="" width="100%" />
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>

        <?php require_once('./inc/vt-footer-m.php');?>
        <?php require_once('./inc/m-fixed-bottom.php');?>

    <?php } else { ?>
        <?php require_once('./inc/vt-header-main.php');?>
        <?php require_once('./inc/notice-common-pc.php');?>
<!--        --><?php //require_once ('../inc/free-list-pc.php');?>
        <?php require_once('./inc/banner-top-pc.php');?>


        <div class="contents-pc">
            <div class="board-top-area">
                <div class="board-top-area-inner clearfix">
                    <div class="board-top-area-list">
<!--                        <a href="--><?php //echo EVENT_PAGE_URL;?><!--" target="_blank">-->
<!--                            <img src="--><?php //echo ROOT;?><!--assets/img/banner/pc/ban-free-profit.jpg" alt="" width="315" />-->
<!--                        </a>-->
                        <img src="<?php echo ROOT;?>assets/img/banner/pc/btn-account-info-main-pc.png" alt="" width="315" />
                    </div>
                    <div class="board-top-area-list">
                        <div class="board-top-area-list-inner">
                            <div class="board-top-area-title">
                                공지사항
                                <a href="notice.php" class="btn-more-link-board">더보기+</a>
                            </div>
                            <ul class="board-top-list-body">
                                <?php for($nl2=0,$size_nl2=count($notice_lists2);$nl2<$size_nl2;$nl2++){
                                    $registered_dt=new DateTime($notice_lists2[$nl2]['registered_dt']);
                                    $today=new DateTime(getToday('Y-m-d H:i:s'));
                                ?>
                                    <li class="board-top-list">
                                        <a href="notice_view.php?id=<?php echo $notice_lists2[$nl2]['id'];?>"
                                           style="<?php if(date_diff($registered_dt, $today)->days >= 7){ echo "padding-right: 0;"; } ?>"
                                           class="board-top-link">
                                            <?php echo $notice_lists2[$nl2]['title'];?>

                                            <?php if(date_diff($registered_dt, $today)->days < 7){ ?>
                                                <small class="ico-new ico-new-01">NEW</small>
                                            <?php } ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="board-top-area-list">
                        <div class="board-top-area-list-inner">
                            <div class="board-top-area-title">
                                언론보도
                                <a href="media.php" class="btn-more-link-board">더보기+</a>
                            </div>
                            <ul class="board-top-list-body">
                                <?php for($ml=0,$size_ml=count($media_lists);$ml<$size_ml;$ml++){
                                    $registered_dt=new DateTime($media_lists[$ml]['registered_dt']);
                                    $today=new DateTime(getToday('Y-m-d H:i:s'));
                                    ?>
                                    <li class="board-top-list">
                                        <a href="media_view.php?id=<?php echo $media_lists[$ml]['id'];?>"
                                           style="<?php if(date_diff($registered_dt, $today)->days >= 7){ echo "padding-right: 0;"; } ?>"
                                           class="board-top-link">
                                            <?php echo $media_lists[$ml]['title'];?>

                                            <?php if(date_diff($registered_dt, $today)->days < 7){ ?>
                                                <small class="ico-new ico-new-01">NEW</small>
                                            <?php } ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="board-top-area-list">
                        <div class="board-top-area-list-inner">
                            <div class="board-top-area-title">
                                장전뉴스
                                <a href="market_news.php" class="btn-more-link-board">더보기+</a>
                            </div>
                            <ul class="board-top-list-body">
                                <?php for($mn=0,$size_mn=count($market_news_lists);$mn<$size_mn;$mn++){
                                    $registered_dt=new DateTime($market_news_lists[$mn]['registered_dt']);
                                    $today=new DateTime(getToday('Y-m-d H:i:s'));
                                    ?>
                                    <li class="board-top-list">
                                        <a href="market_news_view.php?id=<?php echo $market_news_lists[$mn]['id'];?>"
                                           style="<?php if(date_diff($registered_dt, $today)->days >= 7){ echo "padding-right: 0;"; } ?>"
                                           class="board-top-link">
                                            <?php echo $market_news_lists[$mn]['title'];?>

                                            <?php if(date_diff($registered_dt, $today)->days < 7){ ?>
                                                <small class="ico-new ico-new-01">NEW</small>
                                            <?php } ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mid-ban-area-pc">
                <a href="javascript:alert('준비중입니다.');">
                    <img src="<?php echo ROOT;?>assets/img/banner/pc/banner-pc-mid-youtube.jpg?v=1" alt="" width="1200" />
                </a>
            </div>

            <div class="profit-preview-pc">
                <div class="profit-preview-pc-inner clearfix">
                    <div class="profit-preview-list">
                        <div class="profit-preview-list-head">
                            <img src="<?php echo ROOT;?>assets/img/pc/img-profit-tit-01.jpg" alt="" />
                        </div>
                        <div class="profit-preview-list-body">
                            <ul class="main-board-con-body">
                                <?php if(count($member_profit_lists) == 0){ ?>
                                    <li class="main-board-con-list" style="height: 250px;line-height:250px;text-align: center;font-size: 13px;color: #999;border: none;">
                                        아직 등록된 글이 없습니다.
                                    </li>
                                <?php } ?>
                                <?php for($mp=0,$size_mp=count($member_profit_lists);$mp<$size_mp;$mp++){ ?>
                                    <li class="main-board-con-list">
                                        <a href="member_profit_view.php?id=<?php echo $member_profit_lists[$mp]['id'];?>" class="main-board-con-link">
                                            <?php echo $member_profit_lists[$mp]['title'];?>

                                            <?php
                                            $registered_dt=new DateTime($member_profit_lists[$mp]['registered_dt']);
                                            $today=new DateTime(getToday('Y-m-d H:i:s'));
                                            if(date_diff($registered_dt, $today)->days < 7){?>
                                                <small class="ico-new ico-new-01">NEW</small>
                                            <?php } ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                            <?php if(count($member_profit_lists) > 0){ ?>
                                <div class="main-board-con-btn-area">
                                    <a href="member_profit.php" class="main-board-con-btn-more">더보기</a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="profit-preview-list">
                        <div class="profit-preview-list-head">
                            <img src="<?php echo ROOT;?>assets/img/pc/img-profit-tit-02.jpg?v=<?php echo $info[0]['deploy_version'];?>" alt="" />
                        </div>
                        <div class="profit-preview-list-body">
                            <ul class="main-board-con-body">
                                <li class="main-board-con-list" style="border: none;">
                                    <table class="jp-table-m">
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
                                        <?php if(count($free_profit_lists) == 0){ ?>
                                            <tr>
                                                <td colspan="5" style="border: none;">
                                                    <div style="height: 177px;line-height:177px;text-align: center;font-size: 13px;color: #999;">
                                                        아직 등록된 글이 없습니다.
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <?php for($fp=0,$size_fp=count($free_profit_lists);$fp<$size_fp;$fp++){ ?>
                                            <tr>
                                                <td><?php echo $free_profit_lists[$fp]['author'];?></td>
                                                <td><?php echo $free_profit_lists[$fp]['stock_title'];?></td>
                                                <td><?php echo $free_profit_lists[$fp]['purchase_price'];?></td>
                                                <td><?php echo $free_profit_lists[$fp]['sell_price'];?></td>
                                                <td class="text-red bold700"><?php echo $free_profit_lists[$fp]['profit_rate'];?></td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </li>
                            </ul>
                            <?php if(count($free_profit_lists) > 0){ ?>
                                <div class="main-board-con-btn-area">
                                    <a href="free_profit.php" class="main-board-con-btn-more">더보기</a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="profit-preview-list">
                        <div class="profit-preview-list-head">
                            <img src="<?php echo ROOT;?>assets/img/pc/img-profit-tit-03.jpg" alt="" />
                        </div>
                        <div class="profit-preview-list-body">
                            <ul class="main-board-con-body">
                                <li class="main-board-con-list" style="border: none;">
                                    <table class="jp-table-m">
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
                                        <?php if(count($vip_profit_lists) == 0){ ?>
                                            <tr>
                                                <td colspan="5" style="border: none;">
                                                    <div style="height: 177px;line-height:177px;text-align: center;font-size: 13px;color: #999;">
                                                        아직 등록된 글이 없습니다.
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <?php for($vp=0,$size_vp=count($vip_profit_lists);$vp<$size_vp;$vp++){ ?>
                                            <tr>
                                                <td><?php echo $vip_profit_lists[$vp]['author'];?></td>
                                                <td><?php echo $vip_profit_lists[$vp]['stock_title'];?></td>
                                                <td><?php echo $vip_profit_lists[$vp]['purchase_price'];?></td>
                                                <td><?php echo $vip_profit_lists[$vp]['sell_price'];?></td>
                                                <td class="text-red bold700"><?php echo $vip_profit_lists[$vp]['profit_rate'];?></td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </li>
                            </ul>
                            <?php if(count($vip_profit_lists) > 0){ ?>
                                <div class="main-board-con-btn-area">
                                    <a href="notice.php" class="main-board-con-btn-more">더보기</a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="best-profit-area">
                <div class="best-profit-area-inner">
                    <div class="best-profit-area-head">
                        <img src="<?php echo ROOT;?>assets/img/pc/best-profit-tit.png" alt="" />
                    </div>
                    <div class="best-profit-area-body">
                        <div class="best-profit-area-body-wrp">
                            <!-- best swiper -->
                            <div class="swiper-container vt-swiper-container-home-best">
                                <div class="swiper-wrapper">
                                    <?php for($bl=0,$size_bl=count($best_profit_lists);$bl<$size_bl;$bl++){ ?>
                                        <div class="swiper-slide">
                                            <a href="best_profit_view.php?id=<?php echo $best_profit_lists[$bl]['id'];?>" style="margin: 0 10px;display: block;">
                                                <img src="<?php echo ROOT;?>assets/uploads/best_profit/<?php echo $best_profit_lists[$bl]['thumbnail'];?>" alt=""
                                                     style="width: 100%;" />
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <a href="#" class="swiper-button-prev btn-best-profit-prev"></a>
                            <a href="#" class="swiper-button-next btn-best-profit-next"></a>
                            <!-- // best swiper -->
                        </div>
                    </div>
                </div>
            </div>


            <!-- 투자성과 -->
            <div class="current-invest-service profit-result-area">
                <div class="current-invest-service-head">
                    <strong style="color: #ff2a34;">한국경제투자TV</strong> 투자성과
                </div>
                <div class="current-invest-service-inner clearfix">
                    <div class="current-service-m-list" style="width: 432px;">
                        <a href="free_profit.php" class="current-service-m-link">
                            <img src="<?php echo ROOT;?>assets/img/banner/img-result-shortcut-profit.jpg?v=1" alt="" width="100%" />
                        </a>
                    </div>
                    <div class="current-service-m-list">
                        <a href="free_profit.php" class="current-service-m-link">
                            <img src="<?php echo ROOT;?>assets/img/banner/tmp_profit_result_01.jpg?v=2" alt="" width="100%" />
                        </a>
                    </div>
                    <div class="current-service-m-list">
                        <a href="free_profit.php" class="current-service-m-link">
                            <img src="<?php echo ROOT;?>assets/img/banner/tmp_profit_result_02.jpg?v=2" alt="" width="100%" />
                        </a>
                    </div>
                    <div class="current-service-m-list">
                        <a href="free_profit.php" class="current-service-m-link">
                            <img src="<?php echo ROOT;?>assets/img/banner/tmp_profit_result_03.jpg?v=2" alt="" width="100%" />
                        </a>
                    </div>
                </div>
            </div>

            <!-- 진행중인 투자서비스 -->
            <div class="current-invest-service">
                <div class="current-invest-service-head">
                    진행중인 투자서비스
                </div>
                <div class="current-invest-service-inner clearfix">
                    <div class="current-service-m-list">
                        <a href="vip.php" class="current-service-m-link">
                            <div class="current-service-body">
                                <div class="service-thumbnail-wrp">
                                    <img src="<?php echo ROOT;?>assets/img/invest_service/gold.png" alt="" width="100%" />
                                </div>
                                <div class="service-title">
                                    GOLD 투자서비스
                                </div>
                                <div class="service-detail-info clearfix">
                                    <div class="service-detail-box">
                                        <div class="upper">
                                            서비스 기간
                                        </div>
                                        <div class="downer">
                                            3개월
                                        </div>
                                    </div>
                                    <div class="service-detail-box">
                                        <div class="upper">
                                            추천 투자금
                                        </div>
                                        <div class="downer">
                                            1천만원 이하
                                        </div>
                                    </div>
                                    <div class="service-detail-box">
                                        <div class="upper">
                                            투자유형
                                        </div>
                                        <div class="downer">
                                            단기/스윙
                                        </div>
                                    </div>
                                </div>
                                <div class="service-status">
                                    <div class="service-status-01 clearfix">
                                        <span class="left">서비스이용자(1000명 제한)</span>
                                        <span class="right">30%</span>
                                    </div>
                                    <div class="service-status-02">
                                        <div class="gauge"><div class="gauge-inner" style="width: 52%"></div></div>
                                    </div>
                                    <div class="service-status-03 clearfix">
                                        <span class="left"><span class="txt-red">520명</span> / 1,000명</span>
                                        <span class="right">모집중</span>
                                    </div>
                                </div>
                            </div>
                            <div class="current-service-foot">
                                <span class="btn-details-link">자세히 보기</span>
                            </div>
                        </a>
                    </div>
                    <div class="current-service-m-list">
                        <a href="vip.php" class="current-service-m-link">
                            <div class="current-service-body">
                                <div class="service-thumbnail-wrp">
                                    <img src="<?php echo ROOT;?>assets/img/invest_service/vip.png" alt="" width="100%" />
                                </div>
                                <div class="service-title">
                                    VIP 투자서비스
                                </div>
                                <div class="service-detail-info clearfix">
                                    <div class="service-detail-box">
                                        <div class="upper">
                                            서비스 기간
                                        </div>
                                        <div class="downer">
                                            12개월
                                        </div>
                                    </div>
                                    <div class="service-detail-box">
                                        <div class="upper">
                                            추천 투자금
                                        </div>
                                        <div class="downer">
                                            3천만원 이하
                                        </div>
                                    </div>
                                    <div class="service-detail-box">
                                        <div class="upper">
                                            투자유형
                                        </div>
                                        <div class="downer">
                                            정보주/일정주
                                        </div>
                                    </div>
                                </div>
                                <div class="service-status">
                                    <div class="service-status-01 clearfix">
                                        <span class="left">서비스이용자(600명 제한)</span>
                                        <span class="right">33%</span>
                                    </div>
                                    <div class="service-status-02">
                                        <div class="gauge"><div class="gauge-inner" style="width: 33%"></div></div>
                                    </div>
                                    <div class="service-status-03 clearfix">
                                        <span class="left"><span class="txt-red">198명</span> / 600명</span>
                                        <span class="right">모집중</span>
                                    </div>
                                </div>
                            </div>
                            <div class="current-service-foot">
                                <span class="btn-details-link">자세히 보기</span>
                            </div>
                        </a>
                    </div>
                    <div class="current-service-m-list">
                        <a href="vip.php" class="current-service-m-link">
                            <div class="current-service-body">
                                <div class="service-thumbnail-wrp">
                                    <img src="<?php echo ROOT;?>assets/img/invest_service/platinum.png" alt="" width="100%" />
                                </div>
                                <div class="service-title">
                                    PLATINUM 투자서비스
                                </div>
                                <div class="service-detail-info clearfix">
                                    <div class="service-detail-box">
                                        <div class="upper">
                                            서비스 기간
                                        </div>
                                        <div class="downer">
                                            12개월
                                        </div>
                                    </div>
                                    <div class="service-detail-box">
                                        <div class="upper">
                                            추천 투자금
                                        </div>
                                        <div class="downer">
                                            5천만원 이하
                                        </div>
                                    </div>
                                    <div class="service-detail-box">
                                        <div class="upper">
                                            투자유형
                                        </div>
                                        <div class="downer">
                                            장기주/세력주
                                        </div>
                                    </div>
                                </div>
                                <div class="service-status">
                                    <div class="service-status-01 clearfix">
                                        <span class="left">서비스이용자(300명 제한)</span>
                                        <span class="right">19%</span>
                                    </div>
                                    <div class="service-status-02">
                                        <div class="gauge"><div class="gauge-inner" style="width: 19%"></div></div>
                                    </div>
                                    <div class="service-status-03 clearfix">
                                        <span class="left"><span class="txt-red">57명</span> / 300명</span>
                                        <span class="right">모집중</span>
                                    </div>
                                </div>
                            </div>
                            <div class="current-service-foot">
                                <span class="btn-details-link">자세히 보기</span>
                            </div>
                        </a>
                    </div>
                    <div class="current-service-m-list">
                        <a href="vip.php" class="current-service-m-link">
                            <div class="current-service-body">
                                <div class="service-thumbnail-wrp">
                                    <img src="<?php echo ROOT;?>assets/img/invest_service/firstclass.png" alt="" width="100%" />
                                </div>
                                <div class="service-title">
                                    FIRST CLASS 고액자산가
                                </div>
                                <div class="service-detail-info clearfix">
                                    <div class="service-detail-box">
                                        <div class="upper">
                                            서비스 기간
                                        </div>
                                        <div class="downer">
                                            12개월
                                        </div>
                                    </div>
                                    <div class="service-detail-box">
                                        <div class="upper">
                                            추천 투자금
                                        </div>
                                        <div class="downer">
                                            1억원 이하
                                        </div>
                                    </div>
                                    <div class="service-detail-box">
                                        <div class="upper">
                                            투자유형
                                        </div>
                                        <div class="downer">
                                            고액자산가
                                        </div>
                                    </div>
                                </div>
                                <div class="service-status">
                                    <div class="service-status-01 clearfix">
                                        <span class="left">서비스이용자(100명 제한)</span>
                                        <span class="right">3%</span>
                                    </div>
                                    <div class="service-status-02">
                                        <div class="gauge"><div class="gauge-inner" style="width: 3%"></div></div>
                                    </div>
                                    <div class="service-status-03 clearfix">
                                        <span class="left"><span class="txt-red">3명</span> / 100명</span>
                                        <span class="right">모집중</span>
                                    </div>
                                </div>
                            </div>
                            <div class="current-service-foot">
                                <span class="btn-details-link">자세히 보기</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="report-area-pc">
<!--                <img src="--><?php //echo ROOT;?><!--assets/img/tmp/tmp-report-pc.jpg" alt="" width="1201" />-->
                <img src="<?php echo ROOT;?>assets/img/tmp/tmp-under-construction.png" alt="" width="1200" />
            </div>

            <div class="quick-guide-area">
                <div class="quick-guide-area-inner clearfix">
                    <div class="quick-guide-left">
                        <div>
                            <a href="#none" style="cursor: default;">
                                <img src="<?php echo ROOT;?>assets/img/pc/img-reg-summary.jpg?v=1" alt="" />
                            </a>
                        </div>
                        <div class="clearfix quick-guide-btns">
                            <a href="<?php echo EVENT_PAGE_URL;?>" target="_blank">
                                <img src="<?php echo ROOT;?>assets/img/pc/btn-req-vip.jpg" alt="" />
                            </a>
                            <a href="free_profit.php">
                                <img src="<?php echo ROOT;?>assets/img/pc/btn-view-profit.jpg" alt="" />
                            </a>
                        </div>
                    </div>
                    <div class="quick-guide-right">
                        <div style="margin-bottom: 10px;">
                            <a href="vip.php">
                                <img src="<?php echo ROOT;?>assets/img/pc/btn-view-vip-info.jpg" alt="" />
                            </a>
                        </div>
                        <div>
                            <a href="company.php">
                                <img src="<?php echo ROOT;?>assets/img/pc/btn-view-refund.jpg" alt="" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="event-main-area" style="margin-bottom: 30px;">
                <div class="event-main-area-inner">
                    <div class="event-main-area-head">
                        <span>한국경제투자TV</span>
                        <strong>SYSTEM</strong>
                    </div>

                    <div class="event-main-area-body clearfix">
                        <div class="event-main-box">
                            <a href="philosophy.php">
                                <img src="<?php echo ROOT;?>assets/img/banner/pc/btn-quick-ban-01.jpg" alt="" width="100%" />
                            </a>
                        </div>
                        <div class="event-main-box">
                            <a href="strategy.php">
                                <img src="<?php echo ROOT;?>assets/img/banner/pc/btn-quick-ban-02.jpg" alt="" width="100%" />
                            </a>
                        </div>
                        <div class="event-main-box">
                            <a href="refund.php">
                                <img src="<?php echo ROOT;?>assets/img/banner/pc/btn-quick-ban-03.jpg" alt="" width="100%" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="event-main-area">
                <div class="event-main-area-inner">
                    <div class="event-main-area-head">
                        <span>한국경제투자TV</span>
                        <strong>EVENT</strong>
                    </div>

                    <?php if(count($event_lists) == 0){ ?>
                        <div class="event-main-area-body clearfix">
                            <div class="event-main-box">
                                <a href="javascript:alert('준비중입니다.');">
                                    <img src="<?php echo ROOT;?>assets/img/tmp/img-tmp-event.jpg" alt="" width="100%" />
                                </a>
                            </div>
                            <div class="event-main-box">
                                <a href="javascript:alert('준비중입니다.');">
                                    <img src="<?php echo ROOT;?>assets/img/tmp/img-tmp-event.jpg" alt="" width="100%" />
                                </a>
                            </div>
                            <div class="event-main-box">
                                <a href="javascript:alert('준비중입니다.');">
                                    <img src="<?php echo ROOT;?>assets/img/tmp/img-tmp-event.jpg" alt="" width="100%" />
                                </a>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="event-main-area-body clearfix">
                            <?php for($el=0,$size_el=count($event_lists);$el<$size_el;$el++){ ?>
                            <div class="event-main-box">
                                <a href="event_view.phpd=<?php echo $event_lists[$el]['id'];?>">
                                    <img src="<?php echo ROOT;?>assets/uploads/event/<?php echo $event_lists[$el]['thumbnail'];?>" alt="" width="100%" />
                                </a>
                            </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <?php require_once('./inc/vt-footer.php');?>
    <?php } ?>

    <?php require_once('./inc/foot.php');?>
    <?php if(isMobile()){ ?>
        <script src="<?php echo ROOT;?>assets/js/main.m.js?v=<?php echo $info[0]['deploy_version'];?>"></script>
    <?php } else { ?>
        <script src="<?php echo ROOT;?>assets/js/main.pc.js?v=<?php echo $info[0]['deploy_version'];?>"></script>
    <?php } ?>
</body>
</html>