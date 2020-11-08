<?php
require_once('./autoload.php');
require_once('./commons/config.php');
require_once('./commons/utils.php');
define('PAGE','MAIN');

use JCORP\Business\Basics\BasicInfoService as Basic;
$basic=new Basic();

$company_id=1; // 설정시 강제세팅값필요
$info=$basic->getBasicInfoByCompany_id($company_id);

// 이용후기
use \JCORP\Business\News\NewsService as News;
$news=new News();

// 고객센터
use \JCORP\Business\Notice\NoticeService as Notice;
$notice=new Notice();

use \JCORP\Business\Free\FreeExpService as Free;
$free=new Free();

use \JCORP\Business\VIP\VIPService as VIP;
$vip=new VIP();

use \JCORP\Business\Profit\ProfitService as Profit;
$profit=new Profit();

// 무료체험현황 가져오기
$free_list=$free->getListBySize(20);

// 인증 수익율 가져오기
$profit_list=$profit->getList(0, 10);

// VIP 리스트 가져오기
$vip_list=$vip->getListBySize(20);

// 누적 VIP수 가져오기
$vip_total=$vip->totalVIPAmount();

// 누적 수익율
$profit_accum=$profit->getProfitAccumulation();

// 월간 수익율
$profit_month=$profit->getProfitByMonth();

// 주간 수익율
$profit_week=$profit->getProfitByWeek();

// 고객센터 최신 5개의 글 가져오기
$notice_list=$notice->getList(0, 5);

// 이용후기 최신 글 5개 가져오기
$news_list=$news->getList(0,4);

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

    <?php require_once ('./inc/vt-header-main.php');?>

    <div class="vt-free-request-stream">
        <div class="vt-free-request-stream-inner clearfix">
            <div class="vt-free-request-title">
                <img src="<?php echo ROOT;?>assets/img/img-free-req-title.jpg" alt="" />
            </div>
            <div class="vt-free-request-lists">
                <!-- marquee start-->
                <div class="TickerNews" id="T1">
                    <div class="ti_wrapper">
                        <div class="ti_slide clearfix">
                            <div class="ti_content">
                                <?php for($i=0,$size=count($free_list);$i<$size;$i++){ ?>
                                <div class="ti_news">
                                    <span><?php echo $free_list[$i]['user_name'];?>(<?php echo $free_list[$i]['tel_end'];?>)님 </span>
                                    <strong style="margin-right: 50px;">신청완료</strong>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- marquee end -->
            </div>
            
            <div class="vt-wing-body">
                <div>
                    <img src="<?php echo ROOT;?>assets/img/img-wing-01.png" alt="" />
                </div>
                <div style="margin: 5px 0;">
                    <a href="#submission">
                        <img src="<?php echo ROOT;?>assets/img/img-wing-02.png" alt="" />
                    </a>
                </div>
                <div>
                    <a href="tel:<?php echo REPRESENTATIVE_NUMBER;?>">
                        <img src="<?php echo ROOT;?>assets/img/img-wing-03.png" alt="" />
                    </a>
                </div>
                <div style="margin: 5px 0;">
                    <img src="<?php echo ROOT;?>assets/img/img-wing-04.png" alt="" />
                </div>
                <div>
                    <a href="#top">
                        <img src="<?php echo ROOT;?>assets/img/img-wing-btn-top.png" alt="" />
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="vt-main-profit">
        <div class="vt-main-profit-inner clearfix">
            <div class="vt-main-profit-slider">
                <!-- slider -->
                <div class="swiper-container vt-swiper-container-profit-banner">
                    <div class="swiper-wrapper">
                        <?php for($p=0,$size_p=count($profit_list);$p<$size_p;$p++){ ?>
                        <div class="swiper-slide">
                            <a href="<?php echo ROOT;?>profit_view.php?id=<?php echo $profit_list[$p]['id'];?>">
                                <img src="<?php echo ROOT;?>assets/uploads/profit/<?php echo $profit_list[$p]['thumbnail'];?>"
                                     alt=""
                                     width="660" />
                            </a>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="swiper-button-next">
                        >
                    </div>
                    <div class="swiper-button-prev">
                        <
                    </div>
                </div>
                <!-- // slider -->
            </div>
            <div class="vt-main-profit-slider-info">
                <img src="<?php echo ROOT;?>assets/img/img-main-profit-txt.png" alt="" />
                <div style="margin-top: 30px;">
                    <a href="<?php echo ROOT;?>profit.php">
                        <img src="<?php echo ROOT;?>assets/img/vt-btn-red-more.png" alt="더보기" width="120" />
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="vt-main-vip-info">
        <div class="vt-main-vip-info-inner">
            <img src="<?php echo ROOT;?>assets/img/img-main-vip-info.jpg" alt="VIP 서비스" />
        </div>
    </div>

    <div class="vt-user-review">
        <div class="vt-user-review-inner">
            <h6 class="vt-user-review-title">
                이용후기
                <span class="vt-user-review-sub">승리투자그룹을 통해서 얻게 된 놀라운 이용후기를 확인하세요.</span>
            </h6>
            <div class="clearfix">
                <?php for($i=0,$size=count($news_list);$i<$size;$i++){ ?>
                    <div class="vt-main-cs-col-3">
                        <a href="<?php echo ROOT;?>review_view.php?id=<?php echo $news_list[$i]['id'];?>"
                           class="vt-user-review-link">
                            <span class="vt-user-review-img-wrap">
                                <img src="<?php echo ROOT;?>assets/uploads/news/<?php echo $news_list[$i]['thumbnail'];?>"
                                     alt="" />
                            </span>
                            <span class="vt-user-review-info-wrap">
                                <span class="vt-user-review-info-title">
                                    <?php echo $news_list[$i]['title'];?>
                                </span>
                            </span>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <div class="center" style="margin-top: 40px;">
                <a href="<?php echo ROOT;?>review.php">
                    <img src="<?php echo ROOT;?>assets/img/vt-btn-red-more.png" alt="더보기" width="120" />
                </a>
            </div>
        </div>
    </div>

    <div class="vt-register-status">
        <div class="vt-register-status-inner clearfix">
            <div class="vt-register-box">
                <img src="<?php echo ROOT;?>assets/img/img-register-status.png" alt="" />
            </div>
            <div class="vt-register-box">
                <img src="<?php echo ROOT;?>assets/img/img-register-top-01.png" alt="" />
                <div class="vt-register-vip">
                    <!-- ticker 목록 출력 -->
                    <div class="vt-vip-table-holder">
                        <ul class="vt-vip-table clearfix" id="vt-vertical-ticker">
                            <?php for($v=0,$size=count($vip_list);$v<$size;$v++){?>
                            <li>
                                <span class="vt-vip-name"><?php echo $vip_list[$v]['user_name'];?>(<?php echo $vip_list[$v]['tel_end'];?>)</span>
                                <span class="vt-ico-new">new</span>&nbsp;&nbsp;
                                <span class="vt-vip-date"><?php echo setDate($vip_list[$v]['registered_dt']);?></span>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!-- //ticker 목록 출력 -->
                </div>
            </div>
            <div class="vt-register-box">
                <img src="<?php echo ROOT;?>assets/img/img-register-top-02.png" alt="" />
                <div class="vt-register-amount">
                    <span class="vt-register-total">
                        <strong class="vt-register-total-count"><?php echo separateCommaNumber($vip_total[0]['count']);?></strong>
                        명<br />
                        <span>돌파!</span>
                    </span>

                </div>
            </div>
            <div class="vt-register-box">
                <img src="<?php echo ROOT;?>assets/img/img-register-top-03.png" alt="" />
                <div class="vt-register-free">
                    <!-- ticker 목록 출력 -->
                    <div class="vt-vip-table-holder">
                        <ul class="vt-vip-table clearfix" id="vt-vertical-ticker2">
                            <?php for($v=0,$size=count($free_list);$v<$size;$v++){?>
                                <li>
                                    <span class="vt-vip-name"><?php echo $free_list[$v]['user_name'];?>(<?php echo $free_list[$v]['tel_end'];?>)</span>
                                    <span style="font-size: 12px;">님이 신청하셨습니다.</span>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!-- //ticker 목록 출력 -->
                </div>
            </div>
        </div>
    </div>

    <div class="vt-main-profit-info">
        <div class="vt-main-profit-info-inner clearfix">
            <div class="vt-main-profit-box">
                <img src="<?php echo ROOT;?>assets/img/img-main-profit-title.png" alt="" />
            </div>
            <div class="vt-main-profit-box">
                <div class="vt-main-profit-header">
                    <img src="<?php echo ROOT;?>assets/img/img-profit-top-01.png" alt="" />
                </div>

                <div class="vt-main-table-profit-wrapper">
                    <?php for($p=0,$size=count($profit_accum);$p<$size;$p++){ ?>
                    <div class="vt-main-table-profit-row">
                        <div class="vt-main-table-profit-cell">
                            <img src="<?php echo ROOT;?>assets/img/img-rank-0<?php echo $p+1?>.gif" alt="" />
                        </div>
                        <div class="vt-main-table-profit-cell">
                            <?php echo $profit_accum[$p]['name'];?>
                        </div>
                        <div class="vt-main-table-profit-cell">
                            ▲ <?php echo $profit_accum[$p]['percentage'];?>%
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="vt-main-profit-box">
                <div class="vt-main-profit-header">
                    <img src="<?php echo ROOT;?>assets/img/img-profit-top-02.png" alt="" />
                </div>
                <div class="vt-main-table-profit-wrapper">
                    <?php for($p=0,$size=count($profit_month);$p<$size;$p++){ ?>
                        <div class="vt-main-table-profit-row">
                            <div class="vt-main-table-profit-cell">
                                <img src="<?php echo ROOT;?>assets/img/img-rank-0<?php echo $p+1?>.gif" alt="" />
                            </div>
                            <div class="vt-main-table-profit-cell">
                                <?php echo $profit_month[$p]['name'];?>
                            </div>
                            <div class="vt-main-table-profit-cell">
                                ▲ <?php echo $profit_month[$p]['percentage'];?>%
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="vt-main-profit-box">
                <div class="vt-main-profit-header">
                    <img src="<?php echo ROOT;?>assets/img/img-profit-top-03.png" alt="" />
                </div>
                <div class="vt-main-table-profit-wrapper">
                    <?php for($p=0,$size=count($profit_week);$p<$size;$p++){ ?>
                        <div class="vt-main-table-profit-row">
                            <div class="vt-main-table-profit-cell">
                                <img src="<?php echo ROOT;?>assets/img/img-rank-0<?php echo $p+1?>.gif" alt="" />
                            </div>
                            <div class="vt-main-table-profit-cell">
                                <?php echo $profit_week[$p]['name'];?>
                            </div>
                            <div class="vt-main-table-profit-cell">
                                ▲ <?php echo $profit_week[$p]['percentage'];?>%
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>


<!--    --><?php //require_once ('./inc/vt-expert-profile.php');?>

    <div>
        <div style="text-align: center;background: url('<?php echo ROOT;?>assets/img/banner/img-expert-bottom.jpeg') no-repeat center 0">
            <img src="<?php echo ROOT;?>assets/img/banner/img-expert-bottom.jpeg" alt="" style="visibility: hidden;" />
        </div>
    </div>


    <div class="vt-request-form" id="submission">
        <div class="vt-request-form-inner">
            <form action="<?php echo ROOT;?>response/res_gather_request.php" method="post" class="vt-request-form-body">
                <div class="clearfix vt-request-form-wrapper">
                    <img src="<?php echo ROOT;?>assets/img/img-request-title.jpg" alt="" class="vt-request-title" />
                    <div class="vt-request-form-area">
                        <div style="margin-bottom: 20px;">
                            <img src="<?php echo ROOT;?>assets/img/img-request-title2.png" alt="" />
                        </div>
                        <div class="form-group">
                            <input type="text" name="name" class="vt-request-name" required placeholder="이름을 입력하세요." />
                        </div>
                        <div class="form-group">
                            <input type="tel" name="tel" class="vt-request-phone" required placeholder="전화번호를 입력하세요.(- 포함)" />
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="vt-agreement" checked />
                            <label for="vt-agreement">개인정보이동동의</label>
                            <a href="<?php echo ROOT;?>agreement.php" target="_blank" class="vt-request-agree-link">상세보기</a>
                        </div>
                    </div>

                    <div class="vt-request-btn-area">
                        <button type="submit" class="vt-request-free-btn">
                            <img src="<?php echo ROOT;?>assets/img/img-btm-request-free.jpg" alt="" />
                        </button>
                    </div>
                </div>
                <input type="hidden" name="path" value="<?php echo CURRENT_URL;?>" />
                <input type="hidden" name="req_item_type" value="MainHome" />
            </form>
        </div>
    </div>

    <div class="vt-main-cs-center">
        <div class="vt-main-cs-center-inner">
            <div class="clearfix">
                <div class="vt-main-cs-col-3">
                    <div class="vt-main-center-box">
                        <h6 class="vt-main-center-box-title clearfix">
                            고객센터
                            <a href="<?php echo ROOT;?>center.php" style="float: right;">
                                <img src="<?php echo ROOT;?>assets/img/vt-btn-red-more-sm.png" alt="더보기" />
                            </a>
                        </h6>
                        <div class="vt-main-center-con-wrap">
                            <ul class="vt-main-center-con-body">
                                <?php for($i=0,$size=count($notice_list);$i<$size;$i++){?>
                                <li class="vt-main-center-con-list">
                                    <a href="<?php echo ROOT;?>center_view.php?id=<?php echo $notice_list[$i]['id'];?>">
                                        <?php echo $notice_list[$i]['title'];?>
                                    </a>
                                    <span class="vt-center-date"><?php echo setDate($notice_list[$i]['registered_dt']);?></span>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="vt-main-cs-col-3">
                    <img src="<?php echo ROOT;?>assets/img/vt-bank-info.jpeg" alt="" />
                </div>
                <div class="vt-main-cs-col-3">
                    <img src="<?php echo ROOT;?>assets/img/vt-cs-info.jpeg" alt="" />
                </div>
            </div>
        </div>
    </div>

    <?php require_once ('./inc/vt-footer.php');?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js"></script>
    <script src="<?php echo ROOT;?>assets/js/vendors/jquery.tickerNews.min.js"></script>
    <script src="<?php echo ROOT;?>assets/js/vendors/jquery.totemticker.min.js"></script>
    <script src="<?php echo ROOT;?>assets/common.js?v=<?php echo $info[0]['deploy_version'];?>"></script>
    <script>
        new Swiper('.vt-swiper-container-home-banner', {
            pagination: {
                el: '.vt-swiper-pagination-home-banner',
            },
            spaceBetween:0,
            effect: 'slide',
            loop: true,
            autoplay: {
                delay: 5000,
            },
            speed: 800,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            }
        });

        new Swiper('.vt-swiper-container-profit-banner', {
            pagination: {
                el: '.vt-swiper-pagination-profit-banner',
            },
            spaceBetween:0,
            effect: 'slide',
            loop: true,
            autoplay: {
                delay: 5000,
            },
            speed: 800,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            }
        });

        $(function(){
            var timer = !1;
            var _Ticker = $('#T1').newsTicker();
            _Ticker.on('mouseenter',function(){
                var __self = this;
                timer = setTimeout(function(){
                    __self.pauseTicker();
                }, 300);
            });
            _Ticker.on('mouseleave',function(){
                clearTimeout(timer);
                if(!timer) return !1;
                this.startTicker();
            });
        });



        $('#vt-vertical-ticker').totemticker({
            row_height	:	'40px',
            interval	:	3000,
            mousestop	:	true
        });

        $('#vt-vertical-ticker2').totemticker({
            row_height	:	'40px',
            interval	:	2000,
            mousestop	:	true
        });
    </script>
</body>
</html>