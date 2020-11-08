<nav class="jp-navigation">
    <div class="jp-navigation-inner">
        <ul class="jp-navigation-body clearfix">
            <li class="jp-navigation-list">
                <a href="<?php echo ROOT;?>company.php"
                   class="jp-navigation-link <?php if(PAGE == 'COMPANY' or PAGE == 'MEDIA' or PAGE == 'SOCIAL' or PAGE == 'PHILOSOPHY' or PAGE == 'STRATEGY' or PAGE == 'REFUND'){ echo 'jp-navigation-link-active';}?>">
                    회사소개
                </a>
            </li>
            <li class="jp-navigation-list">
                <a href="<?php echo ROOT;?>vip.php"
                   class="jp-navigation-link <?php if(PAGE == 'VIP'){ echo 'jp-navigation-link-active';}?>">
                    유료V.I.P서비스
                </a>
            </li>
            <li class="jp-navigation-list">
                <a href="<?php echo ROOT;?>best_profit.php"
                   class="jp-navigation-link <?php if(PAGE == 'BEST_PROFIT' or PAGE == 'MEMBER_PROFIT' or PAGE == 'REVIEW_PROFIT' or PAGE == 'INTERVIEW'){ echo 'jp-navigation-link-active';}?>">
                    수익후기
                </a>
            </li>
            <li class="jp-navigation-list">
                <a href="<?php echo ROOT;?>market_news.php"
                   class="jp-navigation-link <?php if(PAGE == 'MARKET_NEWS' or PAGE == 'DAILY_NEWS' or PAGE == 'BRIEFING' or PAGE == 'STOCK_SCHEDULE'){ echo 'jp-navigation-link-active';}?>">
                    투자정보
                </a>
            </li>
            <li class="jp-navigation-list">
                <a href="<?php echo ROOT;?>free_profit.php"
                   class="jp-navigation-link <?php if(PAGE == 'FREE_PROFIT' or PAGE == 'VIP_PROFIT'){ echo 'jp-navigation-link-active';}?>">
                    투자성과
                </a>
            </li>
            <li class="jp-navigation-list">
                <a href="<?php echo ROOT;?>notice.php"
                   class="jp-navigation-link <?php if(PAGE == 'NOTICE' or PAGE == 'QNA' or PAGE == 'FAQ' or PAGE == 'USAGE' or PAGE == 'EVENT'){ echo 'jp-navigation-link-active';}?>">
                    고객센터
                </a>
            </li>
        </ul>
        <a href="<?php echo EVENT_PAGE_URL;?>" target="_blank" class="btn-link-on-nav">
             VIP유료서비스 가입신청
<!--            <img src="--><?php //echo ROOT;?><!--assets/img/pc/btn-shortcut-on-nav.png" alt="" />-->
        </a>
    </div>
</nav>