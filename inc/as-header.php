<div class="vt-header">
    <div class="vt-header-top">
        <div class="vt-header-top-inner">
            &nbsp;&nbsp;&nbsp;&nbsp;
            <span>
                <img src="<?php echo ROOT;?>assets/img/ico-phone.jpg" alt="대표전화" width="19" />&nbsp;&nbsp;
                02.1234.1234
            </span>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <span>
                <img src="<?php echo ROOT;?>assets/img/ico-clock.jpg" alt="운영시간" width="19" />&nbsp;&nbsp;
                월-금 9:00 - 18:00 (토,일, 공휴일 제외)
            </span>

        </div>
    </div>

    <hr />

    <div class="vt-header-nav vt-bg-review">
        <div class="vt-header-nav-wrapper">
            <div class="vt-header-nav-inner">
                <h1 class="vt-logo">
                    <a href="/">
                        <img src="<?php echo ROOT;?>assets/img/logo-victory.png" alt="" />
                    </a>
                </h1>
                <nav class="vt-navigation">
                    <ul class="vt-navigation-body clearfix">
                        <li class="vt-navigation-list">
                            <a href="<?php echo ROOT;?>service_info.php" class="vt-navigation-link">
                                HOME
                            </a>
                        </li>
                        <li class="vt-navigation-list">
                            <a href="<?php echo ROOT;?>service.php"
                               class="vt-navigation-link <?php if(PAGE == 'SERVICE'){ echo 'vt-navigation-link-active';}?>">
                                서비스안내
                            </a>
                        </li>
                        <li class="vt-navigation-list">
                            <a href="<?php echo ROOT;?>vip.php"
                               class="vt-navigation-link <?php if(PAGE == 'VIP'){ echo 'vt-navigation-link-active';}?>">
                                VIP가입안내
                            </a>
                        </li>
                        <li class="vt-navigation-list">
                            <a href="<?php echo ROOT;?>profit.php"
                               class="vt-navigation-link <?php if(PAGE == 'PROFIT'){ echo 'vt-navigation-link-active';}?>">
                                수익율인증
                            </a>
                        </li>
                        <li class="vt-navigation-list">
                            <a href="<?php echo ROOT;?>review.php"
                               class="vt-navigation-link <?php if(PAGE == 'REVIEW'){ echo 'vt-navigation-link-active';}?>">
                                이용후기
                            </a>
                        </li>
                        <li class="vt-navigation-list">
                            <a href="<?php echo ROOT;?>center.php"
                               class="vt-navigation-link <?php if(PAGE == 'CENTER'){ echo 'vt-navigation-link-active';}?>">
                                고객센터
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>