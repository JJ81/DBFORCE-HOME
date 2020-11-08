<div class="vt-header">
    <div class="vt-header-top">
        <div class="vt-header-top-inner">
            &nbsp;&nbsp;&nbsp;&nbsp;
            <span>
                <img src="<?php echo ROOT;?>assets/img/ico-phone.jpg" alt="대표전화" width="19" />&nbsp;&nbsp;
                <?php echo REPRESENTATIVE_NUMBER;?>
            </span>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <span>
                <img src="<?php echo ROOT;?>assets/img/ico-clock.jpg" alt="운영시간" width="19" />&nbsp;&nbsp;
                월-금 9:00 - 18:00 (토,일, 공휴일 제외)
            </span>

        </div>
    </div>

    <hr />

    <div class="vt-header-nav vt-bg-main">
        <div class="vt-header-nav-wrapper" style="position: relative; z-index: 100;">
            <div class="vt-header-nav-inner">
                <h1 class="vt-logo">
                    <a href="/">
                        <img src="<?php echo ROOT;?>assets/img/logo-victory.png?v=2" alt="" />
                    </a>
                </h1>
                <nav class="vt-navigation">
                    <ul class="vt-navigation-body clearfix">
                        <li class="vt-navigation-list">
                            <a href="<?php echo ROOT;?>" class="vt-navigation-link">
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

        <!-- rolling banner spot -->
        <div class="vt-main-banner" style="margin-top: -80px;">
            <div class="vt-main-banner-inner">
                <!-- swiper -->
                <div class="swiper-container vt-swiper-container-home-banner">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide" style="background: #060314 url('../../assets/img/banner/img-main-01.jpeg') no-repeat center 0;">
                            <a href="<?php echo ROOT;?>service.php">
                                <img src="<?php echo ROOT;?>assets/img/banner/img-main-01.jpeg" alt="" style="visibility: hidden" />
                            </a>
                        </div>
                        <div class="swiper-slide" style="background: #060314 url('../../assets/img/banner/img-main-02.jpeg') no-repeat center 0;">
                            <a href="<?php echo ROOT;?>profit.php">
                                <img src="<?php echo ROOT;?>assets/img/banner/img-main-02.jpeg" alt="" style="visibility: hidden" />
                            </a>
                        </div>
                        <div class="swiper-slide" style="background: #060314 url('../../assets/img/banner/img-main-03.jpeg') no-repeat center 0;">
                            <a href="<?php echo ROOT;?>vip.php">
                                <img src="<?php echo ROOT;?>assets/img/banner/img-main-03.jpeg" alt="" style="visibility: hidden" />
                            </a>
                        </div>
                        <div class="swiper-slide" style="background: #060314 url('../../assets/img/banner/img-main-04.jpeg') no-repeat center 0;">
                            <a href="<?php echo ROOT;?>review.php">
                                <img src="<?php echo ROOT;?>assets/img/banner/img-main-04.jpeg" alt="" style="visibility: hidden" />
                            </a>
                        </div>
                    </div>
                    <div class="swiper-pagination vt-swiper-pagination-home-banner"></div>
                    <div class="swiper-button-next">
                        <img src="<?php echo ROOT;?>assets/img/ico-arrow-right.png" alt="" />
                    </div>
                    <div class="swiper-button-prev">
                        <img src="<?php echo ROOT;?>assets/img/ico-arrow-left.png" alt="" />
                    </div>
                </div>
                <!-- // swiper -->
            </div>
        </div>
        <!-- // rolling banner spot -->
    </div>
</div>