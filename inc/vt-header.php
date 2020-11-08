<div class="vt-header">
    <div class="vt-header-nav <?php if(PAGE === 'VIP'){ echo 'vt-bg-vip';}else if(PAGE === 'SERVICE'){ echo 'vt-bg-service';}else if(PAGE === 'PROFIT'){ echo 'vt-bg-profit';}else if(PAGE === 'REVIEW'){ echo 'vt-bg-review';}else if(PAGE === 'CENTER'){ echo 'vt-bg-center';}else if(PAGE === 'COMPANY'){echo 'vt-bg-company';}else{ echo 'vt-bg-service';}?>">
        <div class="vt-header-nav-wrapper">
            <div class="vt-header-nav-inner">
                <h1 class="vt-logo">
                    <a href="/">
                        <img src="<?php echo ROOT;?>assets/img/logo_time.png" alt="" />
                    </a>
                </h1>
                <?php require_once ('navigation.php');?>
            </div>
        </div>

        <div class="vt-page-title-in-header">
            <?php
                if(PAGE === 'PROFIT'){
                    ?><h2 class="ti-page-header">수익율 후기</h2><?php
                }else if(PAGE === 'REVIEW'){
                    ?><h2 class="ti-page-header">이용후기</h2><?php
                }else if(PAGE === 'CENTER'){
                    ?><h2 class="ti-page-header">공지사항</h2><?php
                }else if(PAGE === 'COMPANY'){
                    ?><h2 class="ti-page-header">회사소개</h2><?php
                }else if(PAGE === 'SERVICE'){
                    ?><h2 class="ti-page-header">서비스 안내</h2><?php
                }else if(PAGE === 'USAGE'){
                    ?><h2 class="ti-page-header">이용약관</h2><?php
                }else if(PAGE === 'AGREEMENT'){
                    ?><h2 class="ti-page-header">개인정보취급방침</h2><?php
                }else if(PAGE === 'VIP'){
                    ?><h2 class="ti-page-header">VIP 가입안내</h2><?php
                }
            ?>
        </div>
    </div>
</div>

