<div class="vt-free-request-stream">
    <div class="vt-free-request-stream-inner clearfix">
        <div class="ti-notice-stream">
            <div class="vt-free-request-title">
                <img src="<?php echo ROOT;?>assets/img/img-tit-notice-pc.jpg" alt="" style="position: absolute; top: 0; right: 0;" />
            </div>

            <div class="vt-free-request-lists">
                <div class="TickerNews" id="T1">
                    <div class="ti_wrapper">
                        <div class="ti_slide clearfix">
                            <div class="ti_content">
                                <div class="ti_news">
                                <span>
                                    <a href="<?php echo ROOT;?>center.php?id=<?php echo $notice_list[0]['id'];?>"><?php echo $notice_list[0]['title'];?></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once ('./inc/wing-pc.php');?>
    </div>
</div>