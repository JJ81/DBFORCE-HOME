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

    <div class="vt-header-nav <?php if(PAGE === 'VIP'){ echo 'vt-bg-vip';}else if(PAGE === 'SERVICE'){ echo 'vt-bg-service';}else if(PAGE === 'PROFIT'){ echo 'vt-bg-profit';}else if(PAGE === 'REVIEW'){ echo 'vt-bg-review';}else if(PAGE === 'CENTER'){ echo 'vt-bg-center';}else{ echo 'vt-bg-service';}?>">
        <div class="vt-header-nav-wrapper">
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

        <div class="vt-page-title-in-header">
            <?php
                if(PAGE === 'PROFIT'){
                    ?><img src="<?php echo ROOT;?>assets/img/img-txt-profit-title.png" alt="수익율 인증" /><?php
                }else if(PAGE === 'REVIEW'){
                    ?><img src="<?php echo ROOT;?>assets/img/img-txt-review-title.png" alt="이용후기" /><?php
                }else if(PAGE === 'CENTER'){
                    ?><img src="<?php echo ROOT;?>assets/img/img-txt-center-title.png" alt="고객센터" /><?php
                }else if(PAGE === 'VIP'){

                }else if(PAGE === 'SERVICE'){
                    ?><img src="<?php echo ROOT;?>assets/img/img-txt-service-title.png" alt="서비스안내" /><?php
                }else if(PAGE === 'USAGE'){
                    ?><img src="<?php echo ROOT;?>assets/img/img-txt-usage-title.png" alt="이용약관" /><?php
                }else if(PAGE === 'AGREEMENT'){
                    ?><img src="<?php echo ROOT;?>assets/img/img-txt-privacy-title.png" alt="개인정보취급방침" /><?php
                }
            ?>
        </div>
    </div>
</div>