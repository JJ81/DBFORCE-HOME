<div class="vt-header-m">
    <div class="vt-header-m-inner">
        <h1 class="vt-logo-m">
            <a href="/">
                <img src="<?php echo ROOT;?>assets/img/common/logo-common.png"
                     alt=""
                     width="180" />
            </a>
        </h1>
        <a href="#nav" class="vt-btn-nav">
            <img src="<?php echo ROOT;?>assets/img/mobile/ico-hamburger-black.jpg"
                 alt=""
                 width="24" />
        </a>
    </div>
</div>

<hr />

<!-- navigation -->
<div id="navigation-m">
    <div class="navigation-m-inner">
        <ul class="navigation-m-body clearfix">
            <li class="navigation-m-list">
                <a href="/" class="navigation-m-link <?php if(PAGE == 'MAIN'){echo 'navigation-m-active'; }?>">메인</a>
            </li>
            <li class="navigation-m-list">
                <a href="./company.php" class="navigation-m-link <?php if(PAGE == 'COMPANY' or PAGE == 'MEDIA' or PAGE == 'SOCIAL' or PAGE == 'PHILOSOPHY' or PAGE == 'STRATEGY' or PAGE == 'REFUND'){echo 'navigation-m-active'; }?>">회사소개</a>
            </li>
            <li class="navigation-m-list">
                <a href="./vip.php" class="navigation-m-link <?php if(PAGE == 'VIP'){echo 'navigation-m-active'; }?>">유료VIP서비스</a>
            </li>
            <li class="navigation-m-list">
                <a href="./best_profit.php" class="navigation-m-link <?php if(PAGE == 'BEST_PROFIT' or PAGE == 'MEMBER_PROFIT' or PAGE == 'REVIEW_PROFIT' or PAGE == 'INTERVIEW'){echo 'navigation-m-active'; }?>">수익후기</a>
            </li>
            <li class="navigation-m-list">
                <a href="./market_news.php" class="navigation-m-link <?php if(PAGE == 'MARKET_NEWS' or PAGE == 'DAILY_NEWS' or PAGE == 'BRIEFING' or PAGE == 'STOCK_SCHEDULE'){echo 'navigation-m-active'; }?>">투자정보</a>
            </li>
            <li class="navigation-m-list">
                <a href="./free_profit.php" class="navigation-m-link <?php if(PAGE == 'FREE_PROFIT' or PAGE == 'VIP_PROFIT'){echo 'navigation-m-active'; }?>">투자성과</a>
            </li>
            <li class="navigation-m-list">
                <a href="./notice.php" class="navigation-m-link <?php if(PAGE == 'NOTICE' or PAGE == 'QNA' or PAGE == 'FAQ' or PAGE == 'USAGE' or PAGE == 'EVENT'){echo 'navigation-m-active'; }?>">고객센터</a>
            </li>
        </ul>
    </div>
</div>

<?php if(PAGE !== 'MAIN' and PAGE !== 'VIP' and PAGE !== 'PRIVACY' and PAGE !== 'LOGIN' and PAGE !== 'REGISTER'){ ?>
<div id="navigation-m-sub">
    <div class="navigation-m-inner-sub">
        <ul class="navigation-m-sub-body clearfix">

            <?php if(PAGE == 'COMPANY' or PAGE == 'MEDIA' or PAGE == 'SOCIAL' or PAGE == 'PHILOSOPHY' or PAGE == 'STRATEGY' or PAGE == 'REFUND'){ ?>
                <li class="navigation-m-sub-list">
                    <a href="./company.php" class="navigation-m-sub-link <?php if(PAGE == 'COMPANY'){echo 'navigation-m-sub-link-active'; }?>">회사소개</a>
                </li>
                <li class="navigation-m-sub-list">
                    <a href="./philosophy.php" class="navigation-m-sub-link <?php if(PAGE == 'PHILOSOPHY'){echo 'navigation-m-sub-link-active'; }?>">운용철학</a>
                </li>
                <li class="navigation-m-sub-list">
                    <a href="./strategy.php" class="navigation-m-sub-link <?php if(PAGE == 'STRATEGY'){echo 'navigation-m-sub-link-active'; }?>">투자전략본부</a>
                </li>
                <li class="navigation-m-sub-list">
                    <a href="./refund.php" class="navigation-m-sub-link <?php if(PAGE == 'REFUND'){echo 'navigation-m-sub-link-active'; }?>">포트폴리오 최적화</a>
                </li>
                <li class="navigation-m-sub-list">
                    <a href="./media.php" class="navigation-m-sub-link <?php if(PAGE == 'MEDIA'){echo 'navigation-m-sub-link-active'; }?>">언론보도</a>
                </li>
                <li class="navigation-m-sub-list">
                    <a href="./social.php" class="navigation-m-sub-link <?php if(PAGE == 'SOCIAL'){echo 'navigation-m-sub-link-active'; }?>">사회공헌</a>
                </li>
            <?php } ?>


            <?php if(PAGE == 'MARKET_NEWS' or PAGE == 'DAILY_NEWS' or PAGE == 'BRIEFING' or PAGE == 'STOCK_SCHEDULE'){ ?>
                <li class="navigation-m-sub-list">
                    <a href="./market_news.php" class="navigation-m-sub-link <?php if(PAGE == 'MARKET_NEWS'){echo 'navigation-m-sub-link-active'; }?>">장전뉴스</a>
                </li>
                <li class="navigation-m-sub-list">
                    <a href="./daily_news.php" class="navigation-m-sub-link <?php if(PAGE == 'DAILY_NEWS'){echo 'navigation-m-sub-link-active'; }?>">일일시황</a>
                </li>
                <li class="navigation-m-sub-list">
                    <a href="./briefing.php" class="navigation-m-sub-link <?php if(PAGE == 'BRIEFING'){echo 'navigation-m-sub-link-active'; }?>">애널리스트 종목브리핑</a>
                </li>
                <li class="navigation-m-sub-list">
                    <a href="./stock_schedule.php" class="navigation-m-sub-link <?php if(PAGE == 'STOCK_SCHEDULE'){echo 'navigation-m-sub-link-active'; }?>">증시일정</a>
                </li>
            <?php } ?>

            <?php if(PAGE == 'BEST_PROFIT' or PAGE == 'MEMBER_PROFIT' or PAGE == 'REVIEW_PROFIT' or PAGE == 'INTERVIEW') { ?>
                <li class="navigation-m-sub-list">
                    <a href="./best_profit.php" class="navigation-m-sub-link <?php if(PAGE == 'BEST_PROFIT'){echo 'navigation-m-sub-link-active'; }?>">베스트수익후기</a>
                </li>
                <li class="navigation-m-sub-list">
                    <a href="./member_profit.php" class="navigation-m-sub-link <?php if(PAGE == 'MEMBER_PROFIT'){echo 'navigation-m-sub-link-active'; }?>">실시간수익인증</a>
                </li>
                <li class="navigation-m-sub-list">
                    <a href="./review_profit.php" class="navigation-m-sub-link <?php if(PAGE == 'REVIEW_PROFIT'){echo 'navigation-m-sub-link-active'; }?>">고객성공후기</a>
                </li>
                <li class="navigation-m-sub-list">
                    <a href="./interview.php" class="navigation-m-sub-link <?php if(PAGE == 'INTERVIEW'){echo 'navigation-m-sub-link-active'; }?>">고객 인터뷰</a>
                </li>
            <?php } ?>

            <?php if(PAGE == 'FREE_PROFIT' or PAGE == 'VIP_PROFIT'){ ?>
                <li class="navigation-m-sub-list">
                    <a href="./free_profit.php" class="navigation-m-sub-link <?php if(PAGE == 'FREE_PROFIT'){echo 'navigation-m-sub-link-active'; }?>">BLACK MEMBERSHIP</a>
                </li>
                <li class="navigation-m-sub-list">
                    <a href="./vip_profit.php" class="navigation-m-sub-link <?php if(PAGE == 'VIP_PROFIT'){echo 'navigation-m-sub-link-active'; }?>">VIP 투자성과</a>
                </li>
            <?php } ?>

            <?php if(PAGE == 'NOTICE' or PAGE == 'QNA' or PAGE == 'FAQ' or PAGE == 'USAGE' or PAGE == 'EVENT'){ ?>
                <li class="navigation-m-sub-list">
                    <a href="./notice.php" class="navigation-m-sub-link <?php if(PAGE == 'NOTICE'){echo 'navigation-m-sub-link-active'; }?>">공지사항</a>
                </li>
                <li class="navigation-m-sub-list">
                    <a href="./faq.php" class="navigation-m-sub-link <?php if(PAGE == 'FAQ'){echo 'navigation-m-sub-link-active'; }?>">자주묻는질문답변</a>
                </li>
                <li class="navigation-m-sub-list">
                    <a href="./qna.php" class="navigation-m-sub-link <?php if(PAGE == 'QNA'){echo 'navigation-m-sub-link-active'; }?>">1:1문의 게시판</a>
                </li>
                <li class="navigation-m-sub-list">
                    <a href="./event.php" class="navigation-m-sub-link <?php if(PAGE == 'EVENT'){echo 'navigation-m-sub-link-active'; }?>">이벤트</a>
                </li>
                <li class="navigation-m-sub-list">
                    <a href="./usage.php" class="navigation-m-sub-link <?php if(PAGE == 'USAGE'){echo 'navigation-m-sub-link-active'; }?>">투자약관</a>
                </li>
            <?php } ?>

        </ul>
    </div>
</div>
<?php } ?>
<hr />

<!-- login & logout -->
<div id="nav-top-btn-area">
    <div class="nav-top-btn-area-inner clearfix">
        <?php if(empty($_SESSION['user_uuid'])){ ?>
            <a href="./login.php">
                <img src="./assets/img/mobile/btn-login.jpg" alt="로그인" height="30" />
            </a>
            <a href="./register.php">
                <img src="./assets/img/mobile/btn-register.jpg" alt="회원가입" height="30" />
            </a>
        <?php }else{ ?>
        <?php } ?>
        <a href="<?php echo EVENT_PAGE_URL;?>" target="_blank" class="btn-m-top-req">
            <img src="./assets/img/mobile/btn-request.jpg" alt="" height="30"  />
        </a>
    </div>
</div>

<hr />

<!-- notice flip-notice(3 count) -->
<div id="notice-top-m">
    <div class="notice-top-m-inner">
        <div class="notice-m-tit">
            공지사항
        </div>
        <div class="notice-m-con-wrp">
            <!-- 공지사항 -->
            <ul class="rollingMNotice">
                <?php for($nl=0,$size_nl=count($notice_lists);$nl<$size_nl;$nl++){ ?>
                    <li>
                        <a href="./notice_view.php?id=<?php echo $notice_lists[$nl]['id'];?>"><?php echo $notice_lists[$nl]['title'];?></a>
                    </li>
                <?php }?>
            </ul>
            <!-- // 공지사항 -->
        </div>
    </div>
</div>

<hr />

<!-- sidemenu -->
<div class="vt-nav-m">
    <div class="vt-nav-m-inner">

        <div class="vt-header-m" style="position: static;">
            <div class="vt-header-m-inner">
                <h1 class="vt-logo-m">
                    <a href="/">
                        <img src="<?php echo ROOT;?>assets/img/common/logo-common.png"
                             alt=""
                             width="180" />
                    </a>
                </h1>
                <a href="#nav" class="vt-nav-m-close">
                    <img src="<?php echo ROOT;?>assets/img/mobile/btn-close-menu-m.jpg"
                         alt=""
                         width="24" />
                </a>
            </div>
        </div>

        <div id="nav-top-btn-area2" style="border-color: #bfbfbf;">
            <div class="nav-top-btn-area-inner2 clearfix">
                <?php if(empty($_SESSION['user_uuid'])){ ?>
                    <a href="./login.php">
                        <img src="./assets/img/mobile/btn-login.jpg" alt="로그인" height="30" />
                    </a>
                    <a href="./register.php">
                        <img src="./assets/img/mobile/btn-register.jpg" alt="회원가입" height="30" />
                    </a>
                <?php }else{ ?>
                    <a href="./response/res_logout.php">
                        <img src="<?php echo ROOT;?>assets/img/mobile/btn-m-logout.jpg" alt="" height="30" />
                    </a>
                <?php } ?>
                <a href="<?php echo EVENT_PAGE_URL;?>" target="_blank" class="btn-m-top-req">
                    <img src="./assets/img/mobile/btn-request.jpg" alt="" height="30"  />
                </a>
            </div>
        </div>

        <div class="nav-m-wrp-in-menu">
            <div class="nav-m-menu-list">
                <a href="/" class="nav-m-menu-link <?php if(PAGE == 'MAIN'){echo 'active'; }?>">메인</a>
            </div>
            <div class="nav-m-menu-list">
                <a href="./company.php" class="nav-m-menu-link <?php if(PAGE == 'COMPANY' or PAGE == 'MEDIA' or PAGE == 'SOCIAL' or PAGE == 'PHILOSOPHY' or PAGE == 'STRATEGY' or PAGE == 'REFUND'){echo 'active'; }?>">회사소개</a>
                <div class="nav-m-menu-sub-list clearfix" style="<?php if(PAGE == 'COMPANY' or PAGE == 'MEDIA' or PAGE == 'SOCIAL'  or PAGE == 'PHILOSOPHY' or PAGE == 'STRATEGY' or PAGE == 'REFUND'){echo 'display: block;'; }?>">
                    <a href="./company.php" class="nav-m-menu-sub-link">
                        회사소개
                        <img src="<?php echo ROOT;?>assets/img/mobile/ico-angle-right.gif" alt="" class="jp-ico-angle-right" />
                    </a>
                    <a href="./philosophy.php" class="nav-m-menu-sub-link">
                        운용철학
                        <img src="<?php echo ROOT;?>assets/img/mobile/ico-angle-right.gif" alt="" class="jp-ico-angle-right" />
                    </a>
                    <a href="./strategy.php" class="nav-m-menu-sub-link">
                        투자전략본부
                        <img src="<?php echo ROOT;?>assets/img/mobile/ico-angle-right.gif" alt="" class="jp-ico-angle-right" />
                    </a>
                    <a href="./refund.php" class="nav-m-menu-sub-link">
                        포트폴리오 최적화
                        <img src="<?php echo ROOT;?>assets/img/mobile/ico-angle-right.gif" alt="" class="jp-ico-angle-right" />
                    </a>
                    <a href="./media.php" class="nav-m-menu-sub-link">
                        언론보도
                        <img src="<?php echo ROOT;?>assets/img/mobile/ico-angle-right.gif" alt="" class="jp-ico-angle-right" />
                    </a>
                    <a href="./social.php" class="nav-m-menu-sub-link">
                        사회공헌
                        <img src="<?php echo ROOT;?>assets/img/mobile/ico-angle-right.gif" alt="" class="jp-ico-angle-right" />
                    </a>
                </div>
            </div>
            <div class="nav-m-menu-list">
                <a href="./vip.php" class="nav-m-menu-link <?php if(PAGE == 'VIP'){echo 'active'; }?>">유료VIP서비스</a>
            </div>
            <div class="nav-m-menu-list">
                <a href="./best_profit.php" class="nav-m-menu-link <?php if(PAGE == 'BEST_PROFIT' or PAGE == 'MEMBER_PROFIT' or PAGE == 'REVIEW_PROFIT' or PAGE == 'INTERVIEW'){echo 'active'; }?>">수익후기</a>
                <div class="nav-m-menu-sub-list clearfix" style="<?php if(PAGE == 'BEST_PROFIT' or PAGE == 'MEMBER_PROFIT' or PAGE == 'REVIEW_PROFIT' or PAGE == 'INTERVIEW'){echo 'display: block;'; }?>">
                    <a href="./best_profit.php" class="nav-m-menu-sub-link">
                        베스트수익후기
                        <img src="<?php echo ROOT;?>assets/img/mobile/ico-angle-right.gif" alt="" class="jp-ico-angle-right" />
                    </a>
                    <a href="./member_profit.php" class="nav-m-menu-sub-link">
                        실시간수익인증
                        <img src="<?php echo ROOT;?>assets/img/mobile/ico-angle-right.gif" alt="" class="jp-ico-angle-right" />
                    </a>
                    <a href="./review_profit.php" class="nav-m-menu-sub-link">
                        고객성공후기
                        <img src="<?php echo ROOT;?>assets/img/mobile/ico-angle-right.gif" alt="" class="jp-ico-angle-right" />
                    </a>
                    <a href="./interview.php" class="nav-m-menu-sub-link">
                        고객인터뷰
                        <img src="<?php echo ROOT;?>assets/img/mobile/ico-angle-right.gif" alt="" class="jp-ico-angle-right" />
                    </a>
                </div>
            </div>
            <div class="nav-m-menu-list">
                <a href="./market_news.php" class="nav-m-menu-link <?php if(PAGE == 'MARKET_NEWS' or PAGE == 'DAILY_NEWS' or PAGE == 'BRIEFING' or PAGE == 'STOCK_SCHEDULE'){echo 'active'; }?>">투자정보</a>
                <div class="nav-m-menu-sub-list clearfix" style="<?php if(PAGE == 'MARKET_NEWS' or PAGE == 'DAILY_NEWS' or PAGE == 'BRIEFING' or PAGE == 'STOCK_SCHEDULE'){echo 'display: block;'; }?>">
                    <a href="./market_news.php" class="nav-m-menu-sub-link">
                        장전뉴스
                        <img src="<?php echo ROOT;?>assets/img/mobile/ico-angle-right.gif" alt="" class="jp-ico-angle-right" />
                    </a>
                    <a href="./daily_news.php" class="nav-m-menu-sub-link">
                        일일시황
                        <img src="<?php echo ROOT;?>assets/img/mobile/ico-angle-right.gif" alt="" class="jp-ico-angle-right" />
                    </a>
                    <a href="./briefing.php" class="nav-m-menu-sub-link">
                        애널리스트 종목브리핑
                        <img src="<?php echo ROOT;?>assets/img/mobile/ico-angle-right.gif" alt="" class="jp-ico-angle-right" />
                    </a>
                    <a href="./stock_schedule.php" class="nav-m-menu-sub-link">
                        증시일정
                        <img src="<?php echo ROOT;?>assets/img/mobile/ico-angle-right.gif" alt="" class="jp-ico-angle-right" />
                    </a>
                </div>
            </div>
            <div class="nav-m-menu-list">
                <a href="./free_profit.php" class="nav-m-menu-link <?php if(PAGE == 'FREE_PROFIT' or PAGE == 'VIP_PROFIT'){echo 'active'; }?>">투자성과</a>
                <div class="nav-m-menu-sub-list clearfix" style="<?php if(PAGE == 'FREE_PROFIT' or PAGE == 'VIP_PROFIT'){echo 'display: block;'; }?>">
                    <a href="./free_profit.php" class="nav-m-menu-sub-link">
                        BLACK MEMBERSHIP
                        <img src="<?php echo ROOT;?>assets/img/mobile/ico-angle-right.gif" alt="" class="jp-ico-angle-right" />
                    </a>
                    <a href="./vip_profit.php" class="nav-m-menu-sub-link">
                        VIP 투자성과
                        <img src="<?php echo ROOT;?>assets/img/mobile/ico-angle-right.gif" alt="" class="jp-ico-angle-right" />
                    </a>
                </div>
            </div>
            <div class="nav-m-menu-list">
                <a href="./notice.php" class="nav-m-menu-link <?php if(PAGE == 'NOTICE' or PAGE == 'QNA' or PAGE == 'FAQ' or PAGE == 'USAGE' or PAGE == 'EVENT'){echo 'active'; }?>">고객센터</a>
                <div class="nav-m-menu-sub-list clearfix" style="<?php if(PAGE == 'NOTICE' or PAGE == 'QNA' or PAGE == 'FAQ' or PAGE == 'USAGE' or PAGE == 'EVENT'){echo 'display: block;'; }?>">
                    <a href="./notice.php" class="nav-m-menu-sub-link">
                        고객센터
                        <img src="<?php echo ROOT;?>assets/img/mobile/ico-angle-right.gif" alt="" class="jp-ico-angle-right" />
                    </a>
                    <a href="./faq.php" class="nav-m-menu-sub-link">
                        자주묻는질문답변
                        <img src="<?php echo ROOT;?>assets/img/mobile/ico-angle-right.gif" alt="" class="jp-ico-angle-right" />
                    </a>
                    <a href="./qna.php" class="nav-m-menu-sub-link">
                        1:1문의 게시판
                        <img src="<?php echo ROOT;?>assets/img/mobile/ico-angle-right.gif" alt="" class="jp-ico-angle-right" />
                    </a>
                    <a href="./event.php" class="nav-m-menu-sub-link">
                        이벤트
                        <img src="<?php echo ROOT;?>assets/img/mobile/ico-angle-right.gif" alt="" class="jp-ico-angle-right" />
                    </a>
                    <a href="./usage.php" class="nav-m-menu-sub-link">
                        투자약관
                        <img src="<?php echo ROOT;?>assets/img/mobile/ico-angle-right.gif" alt="" class="jp-ico-angle-right" />
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>