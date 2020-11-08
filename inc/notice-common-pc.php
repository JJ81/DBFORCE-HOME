<div class="notice-area-top-pc">
    <div class="notice-area-top-inner">
        <span class="ico-notice-left-pc">
            <img src="<?php echo ROOT;?>assets/img/pc/ico-notice-top.jpg" alt="" />
        </span>
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

<?php require_once ('./inc/free-list-pc.php');?>
<div class="wing-pc-wrp">
    
    <div class="left-wing">
        <a href="javascript:alert('준비중입니다.');">
            <img src="<?php echo ROOT;?>assets/img/wing/left-wing-01.png" alt="" />
        </a>
        <a href="./refund.php">
            <img src="<?php echo ROOT;?>assets/img/wing/left-wing-02.png" alt="" />
        </a>
    </div>

    <div class="right-wing">
<!--        <a href="./philosophy.php">-->
<!--            <img src="--><?php //echo ROOT;?><!--assets/img/wing/right-wing-01.png" alt="" />-->
<!--        </a>-->
<!--        <a href="--><?php //echo EVENT_PAGE_URL;?><!--" target="_blank">-->
<!--            <img src="--><?php //echo ROOT;?><!--assets/img/wing/right-wing-02.png" alt="" />-->
<!--        </a>-->
<!--        <a href="./company.php">-->
<!--            <img src="--><?php //echo ROOT;?><!--assets/img/wing/right-wing-03.png" alt="" />-->
<!--        </a>-->
        <a href="<?php echo EVENT_PAGE_URL;?>" target="_blank">
            <img src="<?php echo ROOT;?>assets/img/wing/right-wing-01.jpg" alt="" width="125" />
        </a>
        <a href="<?php echo ROOT;?>vip_profit.php?page=1">
            <img src="<?php echo ROOT;?>assets/img/wing/right-wing-02.jpg" alt="" width="125" />
        </a>
        <a href="<?php echo ROOT;?>daily_news.php?page=1">
            <img src="<?php echo ROOT;?>assets/img/wing/right-wing-03.jpg" alt="" width="125" />
        </a>
        <a href="<?php echo ROOT;?>review_profit.php?page=1">
            <img src="<?php echo ROOT;?>assets/img/wing/right-wing-04.jpg" alt="" width="125" />
        </a>
        <a href="<?php echo KAKAO_TALK;?>" target="_blank">
            <img src="<?php echo ROOT;?>assets/img/wing/right-wing-05.jpg" alt="" width="125" />
        </a>
        <a href="javascript: goTop();" class="btn-page-top" style="position: relative;left: -1px;">
            <img src="<?php echo ROOT;?>assets/img/wing/right-wing-top.jpg" alt="" width="126" />
        </a>

    </div>
</div>
